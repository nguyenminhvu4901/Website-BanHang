<?php

class HomeModel extends Model
{
    private $_table = 'MyGuests';
    function __construct()
    {
        parent::__construct();
    }

    function tableFill(){
        return 'MyGuests';
    }

    function fieldFill(){
        return '*';
    }

    public function index()
    { 
        $data = $this->db->query("SELECT * FROM $this->_table")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function show($id)
    {
        $data = $this->db->query("SELECT * FROM $this->_table WHERE id = $id")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getTable(){
        $this->db->table('MyGuests')->where('id', '>', 3)->where('firstname', '=', 'John');
    }
}
