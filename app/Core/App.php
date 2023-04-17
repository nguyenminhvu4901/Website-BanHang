<?php
class App
{
    private $controller, $action, $params, $__routes, $__db, $__request;
    static public $app;
    function __construct()
    {
        global $routes, $config;
        self::$app = $this;
        //Khoi tao doi tg Route
        $this->__routes = new Route();
        if (!empty($routes['default_controller'])) {
            $this->controller = $routes['default_controller'];
        }
        $this->action = 'index';
        $this->params = [];
        if (class_exists('DB')) {
            $dbObject = new DB();
            $this->__db = $dbObject->db;
        }
        $this->__request = new Request();
        $this->__request->db = $this->__db;
        //Goi controller tuong ung
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
        //Middleware App
        $this->handleRouteMiddleware($this->__routes->getUri());
        $this->handleGlobalMiddleware();

        $urlArr = array_filter(explode('/', $url));
        $urlArr = array_values($urlArr);
        //Check folder and file in url
        $urlCheck = '';
        if (!empty($urlArr)) {
            foreach ($urlArr as $key => $value) {
                $urlCheck .= $value . '/';
                $fileCheck = rtrim($urlCheck, '/');
                $fileArr = explode('/', $fileCheck);
                $fileArr[count($fileArr) - 1] = ucfirst($fileArr[count($fileArr) - 1]);
                $fileCheck = implode('/', $fileArr);
                if (!empty($urlArr[$key - 1])) {
                    unset($urlArr[$key - 1]);
                }
                if (file_exists("app/Controller/" . $fileCheck . "Controller.php")) {
                    $urlCheck = $fileCheck;
                    break;
                }
            }
            //$urlArr = array_values($urlArr);
        }
        $check = '';
        if (!empty($urlArr[0])) {
            $check = $urlArr[0];
            $this->controller = ucfirst($urlArr[0]);
        } else {
            $this->controller = ucfirst($this->controller);
        }
        //Check if urlCheck empty
        if (empty($urlCheck)) {
            $urlCheck = $this->controller;
        }
        //Di tu index
        if (file_exists("app/Controller/" . $urlCheck . "Controller.php")) {
            require_once "app/Controller/" . $urlCheck . "Controller.php";
            //Check this->controller exists
            if (class_exists($this->controller)) {
                $this->controller = new $this->controller();
                unset($urlArr[0]);
                if (!empty($this->__db)) {
                    $this->controller->db = $this->__db;
                }
            } else {
                $this->loadError();
            }
        } else {
            $this->loadError();
        }
        //Action
        if (!empty($urlArr[1])) {
            if ($urlArr[1] == $check) {
                $this->action = $urlArr[2];
                unset($urlArr[1]);
                unset($urlArr[2]);
            } else {
                $this->action = $urlArr[1];
                unset($urlArr[1]);
            }
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
    //Lay gia tri controller
    public function getCurrentController()
    {
        return $this->controller;
    }

    public function loadError($name = '404', $data = [])
    {
        extract($data);
        require_once('app/Views/Errors/' . $name . '.php');
    }

    public function handleRouteMiddleware($routeKey)
    {
        global $config;
        //Middelware App
        if (!empty($config['app']['routeMiddleware'])) {
            $routeMiddlewareArr = $config['app']['routeMiddleware'];
            foreach ($routeMiddlewareArr as $key => $middlewareItem) {
                if (trim($routeKey) == trim($key) && file_exists('app/Middlewares/' . $middlewareItem . '.php')) {
                    require_once 'app/Middlewares/' . $middlewareItem . '.php';
                    if (class_exists($middlewareItem)) {
                        $middleWareObject = new $middlewareItem();
                        $middleWareObject->handle();
                    }
                }
            }
        }
    }

    public function handleGlobalMiddleware()
    {
        global $config;
        if (!empty($config['app']['globalMiddleware'])) {
            $globalMiddlewareArr = $config['app']['globalMiddleware'];
            foreach ($globalMiddlewareArr as $key => $middlewareItem) {
                if (file_exists('app/Middlewares/' . $middlewareItem . '.php')) {
                    require_once 'app/Middlewares/' . $middlewareItem . '.php';
                    if (class_exists($middlewareItem)) {
                        $middleWareObject = new $middlewareItem();
                        $middleWareObject->handle();
                    }
                }
            }
        }
    }
}
