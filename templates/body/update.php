<?php

use App\Model\Todo;

if (isset($_POST['descriptionModified'])) {
$todo = Todo::findById($_POST['id']);
$todo->setDescription($_POST['descriptionModified']);
$todo->save();
}

header('Location: /todos');