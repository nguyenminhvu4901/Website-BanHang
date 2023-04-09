<?php

class HomeModel
{
    protected $table = "home";
    //Tra ve toan bo
    public function getList()
    {
        $data = [
            'Item 1',
            'a',
            'c'
        ];
        return $data;
    }

    //Tra ve theo id
    public function getDetail($id)
    {
        $data = [
            'Item 1',
            'a',
            'c'
        ];
        return $data[$id];
    }
}
