<?php

class Response
{
    public function redirect($uri=''){
        $url = _WEB_ROOT . '/app/Views/' . $uri . '.php';
        header("location:" .$url);
        exit();
    }
}
