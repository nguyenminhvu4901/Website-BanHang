<?php
class Post
{
    public function index(){
        echo "helo";
    }

    public function detail($id = null, $slug = null){
        echo 'id san pham '.$id.'<br>';
        echo 'slug '.$slug.'<br>';
    }
}
