<?php
//BaseModel

abstract class Model extends Database
{
    protected $db;
    function __construct()
    {
        //Connect DB
        $this->db = new Database();
    }
    // Tên bảng
    abstract function tableFill();
    // Tên các cột cần lấy
    abstract function fieldFill();

    public function fetchAll(){
        $tableName = $this->tableFill();
        $fieldSelect = $this->fieldFill();
        $sql = "SELECT $fieldSelect from $tableName";
        $query = $this->query($sql);
        if(!empty($query)){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }
}
