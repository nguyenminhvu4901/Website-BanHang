<?php

class AuthMiddleware extends Middleware
{
    public function handle()
    {
        if(Session::data('admin-login') == null){
            $response = new Response();
            //$response->redirect('trang-chu');
        }
    }
}
