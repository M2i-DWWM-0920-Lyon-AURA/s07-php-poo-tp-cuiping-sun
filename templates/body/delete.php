<?php

use App\Model\Todo;

$todo = Todo::findById($_POST['deleteId']);
$todo->delete();

header('Location: /todos');
