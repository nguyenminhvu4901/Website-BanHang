<?php

class ProductModel extends Model
{
    private $_table = 'Product';
    function __construct()
    {
        parent::__construct();
    }

    function tableFill()
    {
        return 'Product';
    }

    function fieldFill()
    {
        return '*';
    }

    public function index()
    {
        $data = $this->db->query("SELECT * FROM Product")
            ->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function store($items = [])
    {
        $name = $items['name'];
        $email = $items['email'];
        $password = $items['password'];
        $age = $items['age'];
        $data = $this->db->query("INSERT INTO Product (name, email, password, age) VALUES ('$name', '$email', '$password', '$age')")
            ->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
