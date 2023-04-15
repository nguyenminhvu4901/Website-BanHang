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

    public function store1($items = [])
    {
        $name = $items['name'];
        $email = $items['email'];
        $password = $items['password'];
        $data = $this->db->query("INSERT INTO Product (name, email, password) VALUES ('$name', '$email', '$password')")
            ->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
