<?php

class Request
{
    private $__rules = [], $__messages = [];
    public $__errors = [];
    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isPost()
    {
        if ($this->getMethod() == 'post') {
            return true;
        }
        return false;
    }

    public function isGet()
    {
        if ($this->getMethod() == 'get') {
            return true;
        }
        return false;
    }
    //Lay cac truong du lieu
    public function getFields()
    {
        $dataFields = [];
        //lay du lieu
        if ($this->isGet()) {
            if (!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    if (is_array($value)) {
                        //Lay ca mang
                        $dataFields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        //Chi lay phan tu
                        $dataFields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
        //lay du lieu
        if ($this->isPost()) {
            if (!empty($_POST)) {
                foreach ($_POST as $key => $value) {
                    if (is_array($value)) {
                        $dataFields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $dataFields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
        return $dataFields;
    }
    //Validate

    //Set Rule Value
    public function rules($rules = [])
    {
        $this->__rules = $rules;
        // echo '<pre>';
        // print_r($rules);
        // echo '</pre>';
    }
    //Set message
    public function messages($message = [])
    {
        $this->__messages = $message;
        
    }
    //Run validation
    public function validate()
    {
       
        //Lam min rules
        $this->__rules = array_filter($this->__rules);

        if (!empty($this->__rules)) {
            $dataFields = $this->getFields();
            
            //Lay key trong rule
            //key la name truyen vao cua bien
            foreach ($this->__rules as $key => $value) {
               
                //echo $dataFields[$key];
                //Tach tung rule thanh tung mang
                //$ruleItemArr la cac mang value dieu kien 
                $ruleItemArr = explode('|', $value);
                $ruleName = null;
                $ruleValue = null;
                foreach ($ruleItemArr as $rule) {
                    //Tach tung rule thanh tung mang
                    $ruleArr = explode(':', $rule);
                    //gan phan tu dau tien cua mang vao $ruleName
                    //$ruleName la tung dieu kien validate
                    $ruleName = reset($ruleArr);
                    //if phan tu trong mang lon hon 1 
                    if (count($ruleArr) > 1) {
                        //gan cac phan tu con lai cho $ruleValue
                        //La nhung gia tri sau dau :
                        $ruleValue = end($ruleArr);
                    }
                    //Check từng rule
                    if ($ruleName == 'required') {
                        //kiem tra xem neu nguoi dung khong nhap gia tri
                        if (empty($dataFields[$key])) {
                            $this->__errors[$key][$ruleName] = $this->__messages[$key . '.' . $ruleName];
                        
                        }
                    }



                    // var_dump('Name '.$ruleName.' value '.$ruleValue);
                    // echo '<br>';
                    // echo '<pre>';
                    // print_r($ruleItemArr);
                    // echo '</pre>';
                }
            }
        }
    }

    //Get Errors
    public function errors($fieldName)
    {
    }
}
