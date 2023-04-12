<?php

class Connection
{
    private static $instance = null, $conn;

    private function __construct($config)
    {
        try {
            //Kết nối db
            $con = new PDO("mysql:host=" . $config['host'] . ";dbname=" . $config['db'], $config['user'], $config['password']);
            // set the PDO error mode to exception
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conn = $con;
        } catch (PDOException $e) {
            $mess = $e->getMessage();
            App::$app->loadError('Database', ['mess' => $mess]);
        }
    }

    public static function getInstance($config)
    {
        if (self::$instance === null) {
            $connection = new Connection($config);
            self::$instance = self::$conn;
        }
        return self::$instance;
    }
}
