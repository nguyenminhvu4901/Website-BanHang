<?php
session_start();
require_once "app/Route.php";
$app = new App();
if (!empty($_SERVER['PATH_INFO'])) {
    $url = $_SERVER['PATH_INFO'];
}else{
    $url = "/";
}

