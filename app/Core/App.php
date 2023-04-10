<?php
class App
{
    private $controller;
    private $action;
    private $params;
    private $__routes;
    function __construct()
    {
        global $routes;
        $this->__routes = new Route();
        if (!empty($routes['default_controller'])) {
            $this->controller = $routes['default_controller'];
        }
        $this->action = 'index';
        $this->params = [];
        $this->hanldleUrl();
    }

    function getUrl()
    {
        if (!empty($_SERVER['PATH_INFO'])) {
            $url = $_SERVER['PATH_INFO'];
        } else {
            $url = '/';
        }
        return $url;
    }

    public function hanldleUrl()
    {
        $url = $this->getUrl();
        //Filter URL
        $url = $this->__routes->handleRoute($url);
        $urlArr = array_filter(explode('/', $url));
        $urlArr = array_values($urlArr);
        // $urlCheck = '';
        // foreach ($urlArr as $item) {
        //     echo $item . '<br>';
        // }
        //Controller
        if (!empty($urlArr[0])) {
            $this->controller = ucfirst($urlArr[0]);
        } else {
            $this->controller = ucfirst($this->controller);
        }
        //Di tu index
        if (file_exists("app/Controller/$this->controller" . "Controller.php")) {
            require_once "app/Controller/$this->controller" . "Controller.php";
            //Check this->controller exists
            if (class_exists($this->controller)) {
                $this->controller = new $this->controller();
                unset($urlArr[0]);
            } else {
                $this->loadError();
            }
        } else {
            $this->loadError();
        }
        //Action
        if (!empty($urlArr[1])) {
            $this->action = $urlArr[1];
            unset($urlArr[1]);
        }
        //Params
        $this->params = array_values($urlArr);
        //Check method exists
        if (method_exists($this->controller, $this->action)) {
            call_user_func_array([$this->controller, $this->action], $this->params);
        } else {
            $this->loadError();
        }
    }

    public function loadError($name = '404')
    {
        require_once('app/Views/Errors/' . $name . '.php');
    }
}
