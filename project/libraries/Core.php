<?php

class Core
{
    protected $currentController = 'LedenController';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();

        if (isset($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            $controllerPath = APPROOT . '/controllers/' . $controllerName . '.php';

            if (file_exists($controllerPath)) {
                $this->currentController = $controllerName;
                unset($url[0]);
            }
        }

        require_once APPROOT . '/controllers/' . $this->currentController . '.php';
        $this->currentController = new $this->currentController;

        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }

        return [];
    }
}