<?php
class Post extends Controller
{
    public $data = [];
    public function __construct()
    {
    }
    public function index()
    {
        echo "Ngu";
        // $post = $this->model('PostModel');
        // $dataPost1 = $post->getPostList();
        // $dataPost2 = $post->getPostDetail();
        // $this->data['post_list'] = $dataPost1;
        // $this->data['post_detail'] = $dataPost2;
        // $this->render('Posts/index', $this->data);
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
    }

    public function detail($id = 0)
    {
        $post = $this->model('PostModel');
        $this->data['sub_content']['info'] = $post->getA($id);
        $this->data['content'] = 'Posts/index';
        $this->render('Layouts/Client_Layout', $this->data);
    }

    public function find(){
        echo "tim kiem";
    }
}
