<?php

class PostModel
{
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
