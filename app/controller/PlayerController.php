<?php

class PlayerController extends AuthorizationController

{
    private $viewDir = 'private'
                        . DIRECTORY_SEPARATOR
                        . 'player'
                        . DIRECTORY_SEPARATOR;

    public function index()
    {
        $this->view->render($this->viewDir . 'index',[
            'players'=>Player::loadEverything()
        ]);
    }

    public function new()
    {
        if($_SERVER['REQUEST_METHOD']==='GET'){
            $player = new stdClass();
            $player->name='';
            $player->surname='';
            $player->country='';
            $player->nickname='';
            $player->lane='';
        //    $this->view->render($this->viewDir . 'new',[
        //        'player'=>$player,
        //        'message'=>'Enter the details please'
        //    ]);
            $this->newView($player,'Enter all the details please');
            return;
        }


        $player = (object) $_POST;

        if(strlen(trim($player->nickname))===0){
       //     $this->view->render($this->viewDir . 'new',[
       //         'player'=>$player,
       //         'message'=>'The nickname is required.'
       //     ]);
        $this->newView($player,'The nickname is required');
            return;
        }
        
        if(strlen(trim($player->name))>50){
            $this->newView($player,'The name cannot have more than 50 characters');
            return;
        }

        if(strlen(trim($player->surname))>50){
            $this->newView($player,'The surname cannot have more than 50 characters');
            return;
        }

        if(strlen(trim($player->country))>50){
            $this->newView($player,'The country name cannot have more than 50 characters');
            return;
        }

        if(strlen(trim($player->nickname))>50){
            $this->newView($player,'The nickname cannot have more than 50 characters');
            return;
        }

        if(strlen(trim($player->lane))>50){
            $this->newView($player,'The lane cannot have more than 50 characters');
            return;
        }

        Player::addNew($player);
        $this->index();

    }

    private function newView($player, $message)

    {
        $this->view->render($this->viewDir . 'new',[
            'player'=>$player,
            'message'=>$message
        ]);
    }
}