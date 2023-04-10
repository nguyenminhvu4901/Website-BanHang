<?php

class Home extends Controller
{

    public $modelHome;
    public function __construct()
    {
        // require_once _DIR_ROOT.'/app/Models/HomeModel.php';
        // $this->model = new HomeModel();
        $this->modelHome = $this->model('HomeModel');
    }
    public function index()
    {
        $data = $this->modelHome->getList();
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        $data1 = $this->modelHome->getDetail(1);
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        $this->render('Homes/index', $data);
    }
}
