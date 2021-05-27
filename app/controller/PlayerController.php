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
            $this->view->render($this->viewDir . 'new',[
                'player'=>$player,
                'message'=>'Enter the details please'
            ]);
            return;
        }


        $player = (object) $_POST;

        if(strlen(trim($player->nickname))===0){
            $this->view->render($this->viewDir . 'new',[
                'player'=>$player,
                'message'=>'The nickname is required.'
            ]);
            return;
        }
    }
}