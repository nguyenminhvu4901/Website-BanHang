<?php

class HomeModel extends Model
{
    private $conn;
    protected $_table = 'MyGuests';
    function __construct()
    {
        parent::__construct();
        // $this->conn = mysqli_connect('127.0.0.1', 'root', '', 'myDB');
        // //Check connection
        // if (!$this->conn) {
        //     die("Connection failed: " . mysqli_connect_error());
        // }
    }
    public function index()
    {
        $data = $this->db->query("SELECT * FROM $this->_table")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function show($id)
    {
        $sql = "SELECT * FROM MyGuests WHERE id = $id";
        $result = mysqli_query($this->conn, $sql);
        //Lay ban ghi dau tien
        $rows = mysqli_fetch_array($result);
        return $rows;
    }
}
