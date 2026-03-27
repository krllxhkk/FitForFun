<?php

class BaseController
{
    public function model($model)
    {
        require_once APPROOT . '/models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = [])
    {
        $viewPath = APPROOT . '/views/' . $view . '.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die('View bestaat niet: ' . $viewPath);
        }
    }
}