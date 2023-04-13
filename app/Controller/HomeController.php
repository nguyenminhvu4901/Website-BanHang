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
        //$name = $_REQUEST['name'];
        $this->render('Homes/create');
    }
    public function store(){
        $request = new Request();
        $data =  $request->getFields()['name'];
        //echo $data;
        $response = new Response();
        $response->redirect('Homes/index');
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        //$this->render('Homes/store');
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

    public function getA(){
       $request = new Request();
       var_dump($request->getMethod());
    }

 
}
