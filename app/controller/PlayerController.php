<?php

class PlayerController extends AuthorizationController

{
    private $viewDir = 'private'
                        . DIRECTORY_SEPARATOR
                        . 'player'
                        . DIRECTORY_SEPARATOR;

    private $player=null;
    private $message='';

    public function index()
    {
        $this->view->render($this->viewDir . 'index',[
            'players'=>Player::loadEverything()
        ]);
    }

    public function new()
    {
        if($_SERVER['REQUEST_METHOD']==='GET'){
            $this->newPlayer();
            return;
        }
        $this-> player = (object) $_POST;
        if(!$this->controlName()){return;}
        if(!$this->controlSurname()){return;}
        if(!$this->controlCountry()){return;}
        if(!$this->controlNickname()){return;}
        if(!$this->controlLane()){return;}
        Player::addNew($this->player);
        $this->index();

        }
        
        public function change()
        {
            if($_SERVER['REQUEST_METHOD']==='GET'){
                if(!isset($_GET['id'])){
                    $ic = new IndexController();
                    $ic->logout();
                    return;
                }
                $this->player = Player::load($_GET['id']);
                $this->message='Change the desired information';
                $this->changeView();
                return;
            }
            $this->player = (object) $_POST;
            if(!$this->controlName()){return;}
            if(!$this->controlSurname()){return;}
            if(!$this->controlNickname()){return;}
            if(!$this->controlLane()){return;}
            Player::changeExisting($this->player);
            $this->index();
        } 
        
        private function newPlayer()
        {
            $this->player = new stdClass();
            $this->player->name='';
            $this->player->surname='';
            $this->player->country='';
            $this->player->nickname='';
            $this->player->lane='';
            $this->message='Enter the details';
            $this->newView();

        }

        private function newView()
        {
            $this->view->render($this->viewDir . 'new',[
                'player'=>$this->player,
                'message'=>$this->message
            ]);
        }

        private function changeView()
        {
            $this->view->render($this->viewDir . 'change',[
                'player'=>$this->player,
                'message'=>$this->message
            ]);
        }

        private function controlName()
        {
            if(strlen(trim($this->player->name))===0){
                $this->message='Name is required';
                $this->newView();
                return false;
            }
            if(strlen(trim($this->player->name))>50){
                $this->message='The name cannot have more than 50 characters';
                $this->newView();
                return false;
        }
        return true;
    }

        private function controlSurname()
        {
            if(strlen(trim($this->player->surname))===0){
                $this->message='Surname is required';
                $this->newView();
                return false;
            }
            if(strlen(trim($this->player->surname))>50){
                $this->message='The surname cannot have more than 50 characters';
                $this->newView();
                return false;
        }
        return true;
     }

        private function controlNickname()
        {
         if(strlen(trim($this->player->nickname))===0){
             $this->message='Nickname is required';
             $this->newView();
             return false;
         }
         if(strlen(trim($this->player->nickname))>50){
             $this->message='The nickname cannot have more than 50 characters';
             $this->newView();
             return false;
        }
        return true;
 }

        private function controlCountry()
        {
         if(strlen(trim($this->player->country))===0){
             $this->message='Country is required';
             $this->newView();
             return false;
         }
         if(strlen(trim($this->player->country))>50){
             $this->message='The country cannot have more than 50 characters';
             $this->newView();
             return false;
        }
        return true;
 }

        private function controlLane()
        {
         if(strlen(trim($this->player->lane))===0){
             $this->message='Lane is required';
             $this->newView();
             return false;
         }
         if(strlen(trim($this->player->lane))>10){
             $this->message='The lane cannot have more than 10 characters';
             $this->newView();
             return false;
        }
        return true;
    }
}

