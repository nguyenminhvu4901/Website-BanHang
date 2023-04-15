<?php

class Controller
{
    public $db;
    //tra ve model
    public function model($model)
    {
        if (file_exists(_DIR_ROOT . '/app/Models/' . $model . '.php')) {
            require_once _DIR_ROOT . '/app/Models/' . $model . '.php';
            if (class_exists($model)) {
                $model = new $model();
                return $model;
            }
        }
        return false;
    }

    //Tra ve view
    public function render($view, $data = [])
    {
        extract($data);
        if (file_exists(_DIR_ROOT . '/app/Views/' . $view . '.php')) {
            require_once _DIR_ROOT . '/app/Views/' . $view . '.php';
        } else {
            require_once _DIR_ROOT . '/app/Views/Errors/404.php';
        }
    }
}
