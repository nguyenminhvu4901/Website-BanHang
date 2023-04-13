<?php
class Product extends Controller
{
    public function index()
    {
        echo "Day la san pham";
    }

    public function create()
    {
        $this->render('Products/create');
    }

    public function store()
    {
        $request = new Request();
        //Set rule
        $request->rules([
            'name' => 'required|string|min:2,3,4',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'repassword' => 'required|min:8|match:password',

        ]);
        //Set message
        $request->messages([
            'name.required' => 'Họ tên không được để trống',
            'name.min' => 'Tên phải có ít nhất 2 kí tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Cần nhập đúng định dạng email',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu cần ít nhất 8 kí tự',
            'repassword.required' => 'Cần phải nhập lại mật khẩu',
            'repassword.match' => 'Mật khẩu nhập lại cần phải trùng khớp với mật khẩu trên',
        ]);
        $validate = $request->validate();

        echo '<pre>';
        print_r($request->__errors);
        echo '</pre>';
        //$this->render('Products/store');
    }

    public function detail()
    {

        echo "Day la detail product";
    }
}
