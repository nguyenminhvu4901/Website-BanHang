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
        $data['msg'] =  Session::flash('msg');
        $data['mess'] = Session::flash('mess');
        $result = $this->province->index();
        $data['result'] = $result;
        $this->render('Products/index', $data);
    }

    public function create()
    {
        //Loi va old data luu tu core/request -> helpers/helper.php va goi ra view 
        //In ra loi
        // $this->data['errors'] =  Session::flash('errors');
        //In ra thong bao
        $this->data['msg'] = Session::flash('msg');
        //In ra du lieu cu
        //$this->data['old'] = Session::flash('old');
        $this->render('Products/create', $this->data);
    }

    public function store()
    {
        $request = new Request();
        $response = new Response();
        if ($request->isPost()) {
            //Set rule
            $request->rules([
                'name' => 'required|min:2',
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
            if (!$validate) {
                Session::flash('msg', 'Đã có lỗi xảy ra, vui lòng thử lại');
                //Session::flash('old', $request->getFields());
                $response->redirect('product/create');
            } else {
                $result = $request->getFields();
                $result['image'] = $_FILES['image'];
                $data = $this->province->store($result);
                Session::flash('msg', 'Thêm product thành công');
                //redirect ve index
                $response->redirect('product/index');
            }
        } else {
            $response->redirect('product/create');
        }
    }

    public function check_age($age)
    {
        if ($age > 20) {
            return true;
        } else {
            return false;
        }
    }

    public function detail($id)
    {
        $result = $this->province->detail($id);
        $data['result'] = $result;
        $this->render("Products/detail", $data);
    }

    public function edit($id)
    {
        $result = $this->province->edit($id);
        $data['result'] = $result;
        $data['msg1'] = Session::flash('msg1');
        $this->render("Products/edit", $data);
    }

    public function update($id)
    {
        $request = new Request();
        $response = new Response();
        if ($request->isPost()) {
            //Set rule
            $request->rules([
                'name' => 'required|min:2',
                'email' => 'required|email|min:6|unique:product:email:id=' . $id,
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
                'age.required' => 'Tuổi không được để trống',
                'age.callback_check_age' => 'Tuổi không được nhỏ hơn 20',
            ]);
            //Check du dk hay khong
            //Nhan gia tri true hoac false
            $validate = $request->validate();
            if (!$validate) {
                //Session::flash('errors', $request->getErrors());
                Session::flash('msg1', 'Đã có lỗi xảy ra, vui lòng thử lại');
                //Session::flash('old', $request->getFields());
                $response->redirect('product/edit/' . $id);
            } else {
                $result = $request->getFields();
                $result['new_image'] = $_FILES['new_image'];
                $data = $this->province->update($id, $result);
                Session::flash('msg', 'Thay đổi product thành công');
                //redirect ve index
                $response->redirect('product/index');
            }
        } else {
            $response->redirect('product/edit/' . $id);
        }
    }

    public function destroy($id)
    {
        $request = new Request();
        $response = new Response();
        $data = $this->province->destroy($id);
        if (!empty($data)) {
            Session::flash('msg', 'Xoá product ' . $id . ' thành công');
            $response->redirect('product/index');
        }else{
            Session::flash('msg', 'Xoá product ' . $id . ' không thành công');
            $response->redirect('product/index');
        }
    }
}
