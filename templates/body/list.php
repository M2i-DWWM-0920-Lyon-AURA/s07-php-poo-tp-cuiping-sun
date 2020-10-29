<?php

use App\Model\Todo;

require '../vendor/autoload.php';

if (isset($_POST['descriptionModified'])) {
    $todo = Todo::findById($_POST['id']);
    $todo->setDescription($_POST['descriptionModified']);
    $todo->update();
}

$todos = Todo::findAll();

?>

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

                <form method="post" action="/todos/<?= $todo->getId() ?>/delete">
                    <input type="hidden" name="deleteId" value="<?= $todo->getId() ?>">
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>

            </div>


        </li>
    <?php endforeach; ?>

</ul>
<form method="post" action="/todos/new" id="add-todo" class="d-flex">
    <input id="add-todo-name" name="description" class="form-control" type="text" placeholder="Entrez une nouvelle tâche" />
    <button type="submit" id="add-todo-button" class="btn btn-success">Ajouter</button>
</form>