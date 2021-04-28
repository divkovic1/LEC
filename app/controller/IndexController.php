<?php

class IndexController extends Controller
{
    public function index()
    {
        $this->view->render('index');
    }

    public function era()
    {
        $this->view->render('era');
    }

    public function contact()
    {
        $this->view->render('contact');
    }

    public function login()
    {
        $this->loginView('','');
    }

    public function logout()
    {
        unset($_SESSION['authorized']);
        session_destroy();
        $this->index();
    }

    public function authorization()
    {
        if(!isset($_POST['email']) || !isset($_POST['password'])){
            $this->login();
            return; //short curcuiting
        }

        if(strlen(trim($_POST['email']))===0){
            $this->loginView('','Email is required');
            return;
        }

        if(strlen(trim($_POST['password']))===0){
            $this->loginView($_POST['email'],'Password is required');
            return;
        }

        $connection = DB::getInstance();
        $expression=$connection->prepare('
        
            select * from operator where email=:email

        ');
        $expression->execute(['email'=>$_POST['email']]);
        $result = $expression->fetch();

        if($result==null){
            $this->loginView($_POST['email'],'Email does not exist in the database');
            return;
        }

        if(!password_verify($_POST['password'],$result->password)){
            $this->loginView($_POST['email'],'Combination of email and password is not correct');
            return;
        }
            


            
    unset($result->password);
    $_SESSION['authorized']=$result;
    $np = new ControlPanelController();
    $np->index();

    }

    private function loginView($email,$poruka)
    {
        $this->view->render('login',[
            'email'=>$email,
            'poruka'=>$poruka
        ]);
    }

    /*
    public function test()
    {
        $connection= DB::getInstance();
        $expression= $connection->prepare('select * from player');
        $expression->execute();
        $results = $expression->fetchAll();
        print_r($results);
    }
    */
}
