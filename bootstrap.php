<?php
// http root
define('_DIR_ROOT', __DIR__);

// http web
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $web_root = 'https://' . $_SERVER['HTTP_HOST'];
} else {
    $web_root = 'http://' . $_SERVER['HTTP_HOST'];
}
$folder = str_replace(strtolower($_SERVER['DOCUMENT_ROOT']), '', strtolower(_DIR_ROOT));
$web_root = $web_root . $folder;
define('_WEB_ROOT', $web_root);

//Auto load configs
$configs_dir = scandir('configs');
if (!empty($configs_dir)) {
    foreach ($configs_dir as $key => $value) {
        if ($value != '.' && $value != '..' && file_exists('configs/' . $value)) {
            require_once 'configs/' . $value;
        }
    }
}
if (!empty($config['app']['services'])) {
    $allServices = $config['app']['services'];
    if (!empty($allServices)) {
        foreach ($allServices as $serviceName) {
            if (file_exists('app/Core/' . $serviceName . '.php')) {
                require_once 'app/Core/' . $serviceName . '.php';
            }
        }
    }
}
//Check config va load DB
if (!empty($config['database'])) {
    $db_config = array_filter($config['database']);
    if (!empty($db_config)) {
        require_once 'core/Connection.php';
        require_once 'core/QueryBuilder.php';
        require_once 'core/Database.php';
        require_once 'core/DB.php';
    }
}

//Load Model
require_once 'core/Load.php';
//Middelware
require_once 'core/Middleware.php';
//Code filter url 
require_once "core/Route.php";
//Session
require_once "core/Session.php";
//Load route de custom url cho controller
require_once "configs/route.php";
//info db
require_once "configs/database.php";
//session
require_once "configs/session.php";

//Load core Helper 
require_once 'core/Helper.php';
//Auto load Helpers
$allHelpers = scandir('app/Helpers');
if (!empty($allHelpers)) {
    foreach ($allHelpers as $key => $value) {
        if ($value != '.' && $value != '..' && file_exists('app/Helpers/' . $value)) {
            require_once 'app/Helpers/' . $value;
        }
    }
}
//Code xu ly chinh url
require_once "app/Core/App.php";
//Mail
require_once "Mail/SendMail.php";
//BaseController
require_once "core/Controller.php";
//Base Model
require_once "core/Model.php";
//Request
require_once "core/Request.php";
//Response
require_once "core/Response.php";
