<?php

class CoachController extends AuthorizationController

{
    private $viewDir = 'private'
                        . DIRECTORY_SEPARATOR
                        . 'coach'
                        . DIRECTORY_SEPARATOR;

    private $entity=null;
    private $message='';

    public function index()
    {
        $this->view->render($this->viewDir . 'index',[
            'entities'=>Coach::loadEverything()
        ]);
    }
    public function new()
    {
        if($_SERVER['REQUEST_METHOD']==='GET'){
            $this->newEntity();
            return;
        }
        $this->entity = (object) $_POST;

        Coach::addNew($this->entity);
        $this->index();
    }

    private function newEntity()
    {
        $this->entity = new stdClass();
        $this->entity->name='';
        $this->entity->surname='';
        $this->entity->nickname='';
        $this->entity->country='';
        $this->message='Please enter the details';
        $this->newView();
    }

    private function newView()
    {
        $this->view->render($this->viewDir . 'new',[
            'entity'=>$this->entity,
            'message'=>$this->message
        ]);
    }

}