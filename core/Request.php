<?php

class Request
{
    private $__rules = [], $__messages = [], $__errors = [];
    public $db;

    function __construct()
    {
        $this->db = new Database();
    }
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
        $checkValidate = true;
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
                    //$ruleName la tung dieu kien validate (required, string,...)
                    $ruleName = reset($ruleArr);
                    //if phan tu trong mang lon hon 1 
                    if (count($ruleArr) > 1) {
                        //gan cac phan tu con lai cho $ruleValue
                        //La nhung gia tri sau dau : (2, 3, password)
                        $ruleValue = end($ruleArr);
                    }
                    //Check từng rule
                    if ($ruleName == 'required') {
                        //kiem tra xem neu nguoi dung khong nhap gia tri
                        if (empty($dataFields[$key])) {
                            $this->setErrors($key, $ruleName);
                            $checkValidate = false;
                        }
                    }

                    if ($ruleName == 'min') {
                        if (strlen(trim($dataFields[$key])) < $ruleValue) {
                            $this->setErrors($key, $ruleName);
                            $checkValidate = false;
                        }
                    }

                    if ($ruleName == 'max') {
                        if (strlen(trim($dataFields[$key])) > $ruleValue) {
                            $this->setErrors($key, $ruleName);
                            $checkValidate = false;
                        }
                    }

                    if ($ruleName == 'email') {
                        if (!filter_var($dataFields[$key], FILTER_VALIDATE_EMAIL)) {
                            $this->setErrors($key, $ruleName);
                            $checkValidate = false;
                        }
                    }

                    if ($ruleName == 'match') {
                        if (trim($dataFields[$key] != trim($dataFields[$ruleValue]))) {
                            $this->setErrors($key, $ruleName);
                            $checkValidate = false;
                        }
                    }
                    //check duy nhat
                    if ($ruleName == 'unique') {
                        //Ten bang
                        $tableName = null;
                        //Ten cot
                        $fieldCheck = null;
                        if (!empty($ruleArr[1])) {
                            $tableName = $ruleArr[1];
                        }

                        if (!empty($ruleArr[2])) {
                            $fieldCheck = $ruleArr[2];
                        }

                        if (!empty($tableName) && !empty($fieldCheck)) {
                            //Ko co them id
                            if (count($ruleArr) == 3) {
                                $result = $this->db->query("SELECT $fieldCheck FROM $tableName WHERE $fieldCheck = '" . trim($dataFields[$fieldCheck]) . "'")->rowCount();
                                //Co them id
                                //Dung trong update
                            } else if (count($ruleArr) == 4) {
                                if (!empty($ruleArr[3] && preg_match('~.+?\=~is', $ruleArr[3]))) {
                                    $conditionWhere = $ruleArr[3];
                                    $conditionWhere = str_replace('=', '<>', $conditionWhere);
                                    $result = $this->db->query("SELECT $fieldCheck FROM $tableName WHERE $fieldCheck = '" . trim($dataFields[$fieldCheck]) . "' AND $conditionWhere")->rowCount();
                                }
                            }

                            if (!empty($result)) {
                                $this->setErrors($key, $ruleName);
                                $checkValidate = false;
                            }
                        }
                    }

                    //Check callback
                    if (preg_match('~^callback_(.+)~is', $ruleName, $callbackArr)) {
                        if (!empty($callbackArr[1])) {
                            //ten sau callback (tuong ung vs ten ham)
                            $callbackName = $callbackArr[1];
                            $controller = App::$app->getCurrentController();
                            //check neu toi tai ham dk
                            if (method_exists($controller, $callbackName)) {
                                $checkCallback = call_user_func_array([$controller, $callbackName], [trim($dataFields[$key])]);
                                if (!$checkCallback) {
                                    $this->setErrors($key, $ruleName);
                                    $checkValidate = false;
                                }
                            }
                        }
                    }
                }
            }
        }
        //gan loi va du lieu cu vao day
        $sessionKey = Session::isInvalid();
        Session::flash($sessionKey.'_errors', $this->getErrors());
        Session::flash($sessionKey.'_old', $this->getFields());
        return $checkValidate;
    }

    //Get Errors
    public function getErrors($fieldName = '')
    {
        if (!empty($this->__errors)) {
            if (empty($fieldName)) {
                $errorsArr = [];
                foreach ($this->__errors as $key => $value) {
                    $errorsArr[$key] = reset($value);
                }
                return $errorsArr;
            }
            //Lay loi dau tien xuat hien cua moi truong
            return reset($this->__errors[$fieldName]);
        }
        return false;
    }

    //Set Errors 
    public function setErrors($key, $ruleName)
    {
        $this->__errors[$key][$ruleName] = $this->__messages[$key . '.' . $ruleName];
    }
}
