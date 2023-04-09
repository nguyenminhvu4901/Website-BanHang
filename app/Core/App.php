<?php
class App
{
    private $controller;
    private $action;
    private $params;
    function __construct()
    {
        global $routes;
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
        
        //Filter URL
        $url = $this->getUrl();
        $urlArr = array_filter(explode('/', $url));
        $urlArr = array_values($urlArr);
        //Controller
        if (!empty($urlArr[0])) {
            $this->controller = ucfirst($urlArr[0]);
        } else {
            $this->controller = ucfirst($this->controller);
        }
      
        //Di tu index
        if (file_exists("app/Controller/$this->controller" . "s/$this->controller" . "Controller.php")) {
            require_once "app/Controller/$this->controller" . "s/$this->controller" . "Controller.php";

            //Check this->controller exsists
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
        require_once('app/View/Errors/' . $name . '.php');
    }
}
