<?php

namespace App\Core;

use PDO;
use PDOStatement;

final class DataBaseHandler
{
    static private $instance;

    private function __construct()
    {
    }

    static function getInstance(): PDO
    {
        if (is_null(static::$instance)) {
            $conn = new PDO("mysql:host=localhost;dbname=php-todos", 'root', 'root');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            static::$instance = $conn;
        }

        return static::$instance;
    }

    static function query(string $sql): PDOStatement
    {
        return static::getInstance()->query($sql);
    }

    static function prepare(string $sql): PDOStatement
    {
        return static::getInstance()->prepare($sql);
    }

    static function lastInsertId()
    {
        return static::getInstance()->lastInsertId();
    }

}