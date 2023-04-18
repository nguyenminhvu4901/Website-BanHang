<?php

class AuthMiddleware extends Middleware
{
    public function handle()
    {
        //C1
        // global $db_config;
        // $conn = Connection::getInstance($db_config);
        // $stmt = $conn->prepare("SELECT * FROM Product");
        // $stmt->execute();
        // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // echo '<pre>';print_r($result); echo '</pre>';

        //C2
        // $data = $this->db->query("SELECT * FROM Product")
        //     ->fetchAll(PDO::FETCH_ASSOC);
        //C3
        // $a = Load::model('ProductModel');
        // $data = $a->index();
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        //Load view
        //Load::view('Homes/hi');
        
        if (Session::data('admin-login') == null) {
            $response = new Response();
            //$response->redirect('trang-chu');
        }
    }
}
