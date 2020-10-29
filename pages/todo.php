<?php

use App\Model\Todo;

require './vendor/autoload.php';

if (isset($_POST['descriptionModified'])) {
    $todo = Todo::findById($_POST['id']);
    $todo->setDescription($_POST['descriptionModified']);
    $todo->update();
}

$todos = Todo::findAll();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Fontawesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/60343a05b6.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <h1>Ma liste de tâches</h1>
        <ul id="todo-list" class="list-group mb-4">

            <?php foreach ($todos as $todo) : ?>
                <li class="list-group-item d-flex justify-content-between">
                    <?php if (isset($_POST['description']) && $_POST['description'] == $todo->getDescription()) : ?>
                        <form method="post" action="/todos/<?= $todo->getId() ?>/update">
                            <input type="hidden" name="id" value="<?= $todo->getId() ?>">
                            <input type="text" name="descriptionModified" value="<?= $todo->getDescription()  ?>">
                            <button type="submit" class="btn btn-success btn-sm mr-1">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                    <?php else : ?>
                        <?php if ($todo->getDone()) : ?>
                            <del class="text-muted">
                                <?= $todo->getDescription() ?>
                            </del>
                        <?php else : ?>
                            <?= $todo->getDescription() ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="d-flex">

                        <?php if (isset($_POST['description']) && $_POST['description'] == $todo->getDescription()) : ?>
                        <?php else : ?>
                            <form method="post" action="/todos/<?= $todo->getId() ?>/update">
                                <input type="hidden" name="rank" value="<?= $todo->getRank() ?>">
                                <input type="hidden" name="id" value="<?= $todo->getId() ?>">
                                <input type="hidden" name="description" value="<?= $todo->getDescription() ?>">
                                <button type="submit" class="btn btn-warning btn-sm mr-1">
                                    <i class="fas fa-pen-nib"></i>
                                </button>
                            </form>
                        <?php endif; ?>

                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>


                </li>
            <?php endforeach; ?>

        </ul>
        <form method="post" action="/todos/new" id="add-todo" class="d-flex">
            <input id="add-todo-name" name="description" class="form-control" type="text" placeholder="Entrez une nouvelle tâche" />
            <button type="submit" id="add-todo-button" class="btn btn-success">Ajouter</button>
        </form>
    </div>
</body>

</html>