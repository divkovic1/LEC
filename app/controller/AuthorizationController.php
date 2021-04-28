<?php

class AuthorizationController extends Controller

{
    public function __construct()
    {
        parent::__construct();
        if(!isset($_SESSION['authorized'])){
            $this->view->render('login',[
                'email'=>'',
                'message'=>'You have to log in first'
            ]);
            exit;
        }
    }
}