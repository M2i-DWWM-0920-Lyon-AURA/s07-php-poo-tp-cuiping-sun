<?php

use App\Model\Todo;

$newTodo = new Todo();
$newTodo
    ->setDescription($_POST['description'])
    ->setRank($newTodo::count() + 1);

$newTodo->save();

header('Location: /todos');
