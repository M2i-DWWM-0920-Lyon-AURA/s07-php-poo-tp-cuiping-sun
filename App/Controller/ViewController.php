<?php

namespace App\Controller;

use App\View\StandarView;

class ViewController
{
    static public function home()
    {
        $home = new StandarView(['home']);
        $home->setPageTitle('home');
        return $home->render();
    }

    static public function List()
    {
        $list = new StandarView(['list']);
        $list->setPageTitle('todo-list');
        return $list->render();
    }

    static public function new()
    {
        require '../templates/body/new.php';
    }

    static public function delete()
    {
        require '../templates/body/delete.php';
    }
}