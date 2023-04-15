<?php
class Product extends Controller
{
    public $province, $data;
    public function __construct()
    {
        $this->province = $this->model('ProductModel');
    }
    public function index()
    {
        $result = $this->province->index();
        $data['result'] = $result;
        $this->render('Products/index', $data);
    }

    public function create()
    {
        $this->render('Products/create');
    }

    public function store()
    {
        $request = new Request();

        if ($request->isPost()) {
            // echo '<pre>';
            // print_r($request->getFields());
            // echo '</pre>';
            //Set rule
            $request->rules([
                'name' => 'required|min:2,3,4',
                'email' => 'required|email|min:6|unique:product:email',
                'password' => 'required|min:8',
                'repassword' => 'required|min:8|match:password',
                'age' => 'required|callback_check_age',

            ]);
            //Set message
            $request->messages([
                'name.required' => 'Họ tên không được để trống',
                'name.min' => 'Tên phải có ít nhất 2 kí tự',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Cần nhập đúng định dạng email',
                'email.min' => 'Email phải có ít nhất 6 kí tự',
                'email.unique' => 'Email đã tồn tại, vui lòng thử lại',
                'password.required' => 'Mật khẩu không được để trống',
                'password.min' => 'Mật khẩu cần ít nhất 8 kí tự',
                'repassword.required' => 'Cần phải nhập lại mật khẩu',
                'repassword.match' => 'Mật khẩu nhập lại cần phải trùng khớp với mật khẩu trên',
                'repassword.min' => 'Mật khẩu cần ít nhất 8 kí tự',
                'age.required' => 'Tuổi không được để trống',
                'age.callback_check_age' => 'Tuổi không được nhỏ hơn 20',
            ]);
            //Check du dk hay khong
            //Nhan gia tri true hoac false
            $validate = $request->validate();
            //
            if (!$validate) {
                //In ra loi
                $this->data['errors'] = $request->getErrors();
                //In ra thong bao
                $this->data['msg'] = 'Đã có lỗi xảy ra, vui lòng thử lại';
                //In ra du lieu cu
                $this->data['old'] = $request->getFields();
                $this->render('Products/create', $this->data);
            } else {
                $result = $request->getFields();
                $data = $this->province->store($result);
                $response = new Response();
                //redirect ve index
                $response->redirect('product/index');
            }
        } else {
            $response = new Response();
            $response->redirect('product/create');
        }
    }

    public function check_age($age){
        if($age > 20){
            return true;
        }else{
            return false;
        }
    }

    public function detail()
    {

        echo "Day la detail product";
    }

    public function edit($id)
    {
    }

    public function update($id)
    {
    }

    public function destroy($id)
    {
    }
}
