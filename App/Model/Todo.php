<?php

namespace App\Model;

use App\Core\DataBaseHandler;
use PDO;

class Todo
{
    private $id;
    private $description;
    private $done;
    private $rank;

    public function __construct(int $id = null, string $description = '', bool $done = false, int $rank = 0)
    {
        $this->id = $id;
        $this->description = $description;
        $this->done = $done;
        $this->rank = $rank;
    }

    static public function findAll()
    {
        $stmt = DataBaseHandler::query('SELECT * FROM `todos`');
        return $stmt->fetchAll(PDO::FETCH_FUNC, function($id, $description, $done, $rank){
            return new Todo($id, $description, $done, $rank);
        });
    }

    static public function findById(int $id)
    {
        $stmt = DataBaseHandler::prepare('SELECT * FROM `todos` WHERE `id` = :id');
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetchAll(PDO::FETCH_FUNC, function ($id, $description, $done, $rank) {
            return new Todo($id, $description, $done, $rank);
        });
        return $result[0];
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of done
     */ 
    public function getDone()
    {
        return $this->done;
    }

    /**
     * Set the value of done
     *
     * @return  self
     */ 
    public function setDone($done)
    {
        $this->done = $done;

        return $this;
    }

    /**
     * Get the value of rank
     */ 
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set the value of rank
     *
     * @return  self
     */ 
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    public function insert(): void
    {
        $stmt = DataBaseHandler::prepare("INSERT INTO todos (description, done, rank) VALUES (:description, :done, :rank)");
        $stmt->execute([
            'description' => $this->description,
            'done' => $this->done,
            'rank' => $this->rank
        ]);
        $this->id = DataBaseHandler::lastInsertId();
    }

    public function update(): void
    {
        $stmt = DataBaseHandler::prepare("UPDATE todos SET description = :description, done = :done, rank = :rank WHERE id = :id");
        $stmt->execute([
            'description' => $this->description,
            'done' => $this->done,
            'rank' => $this->rank,
            'id' => $this->id
        ]);
    }

    public function delete(): void
    {
        $stmt = DataBaseHandler::prepare("DELETE FROM todos WHERE id=:id");
        $stmt->execute(['id' => $this->id]);
    }

    static public function count()
    {
        $stmt = DataBaseHandler::query("SELECT * FROM todos");
        return $stmt->rowCount();
    }
}