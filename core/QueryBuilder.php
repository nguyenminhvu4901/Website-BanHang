<?php
//Custom query builder
trait QueryBuilder {
    public $tableName = '';
    public $where = '';
    public function table($tableName){
         $this->tableName = $tableName; 
         return $this;
    }

    public function where($field, $compare, $value){
        $this->where .= "WHERE $field $compare '$value'";
        echo $this->where;
        return $this;
    }

    public function select($field){

    }
}