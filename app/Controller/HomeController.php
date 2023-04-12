<?php
class Home extends Controller
{
    public $province;
    public function __construct()
    {
        // require_once _DIR_ROOT.'/app/Models/HomeModel.php';
        // $this->model = new HomeModel();
        $this->province = $this->model('HomeModel');
    }
    public function index()
    {
        $result = $this->province->index();
        $data['result'] = $result;
        $this->render('Homes/index', $data);
    }

    public function create()
    {
        $name = $_REQUEST['name'];
        $this->render('Homes/create');
    }

    public function show($id)
    {
        $rows = $this->province->show($id);
        $data['result'] = $rows;
        $this->render('Homes/show', $data);
    }

    public function getTable(){
       $this->province->getTable();  
    }
}
