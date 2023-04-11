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
        $result = $this->modelHome->index();
        $data['result'] = $result;
        //require_once('app/Views/Homes/index.php');
        $this->render('Homes/index', $data);
    }

    public function create()
    {
        $name = $_REQUEST['name'];
        $a = "helo";
        $this->render('Homes/create', compact($a));
    }

    public function show($id)
    {
        $rows = $this->modelHome->show($id);
        require_once('app/Views/Homes/show.php');
    }
}
