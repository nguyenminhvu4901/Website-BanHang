<?php

class PostModel 
{
    private $_table = 'Post';
    // function __construct()
    // {
    //     parent::__construct();
    // }

    // function tableFill(){
    //     return 'MyGuests';
    // }

    // function fieldFill(){
    //     return '*';
    // }
    public function getPostList()
    {
        return [
            'San pham 1',
            'Akjaf',
        ];
    }

    public function getPostDetail()
    {
        return [
            'chi tiet 1',
            'chi tiet 2',
        ];
    }

    public function getA($id)
    {
        $data = [
            'A',
            'B',
            'C'
        ];

        return $data[$id];
    }
}
