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
            'coaches'=>Coach::loadEverything()
        ]);
    }
    public function new()
    {
        if($_SERVER['REQUEST_METHOD']==='GET'){
            $this->newEntity();
            return;
        }
        $this->entity = (object) $_POST;

        try {
            $this->control();
            Coach::addNew($this->entity);
            $this->index();
        } catch (Exception $e) {
            $this->message=$e->getMessage();
            $this->newView();
           
    }
}

    public function change()
    {
        if($_SERVER['REQUEST_METHOD']==='GET'){
            if(!isset($_GET['id'])){
                $ic = new IndexController();
                $ic->logout();
                return;
            }
            $this->entity = Coach::load($_GET['id']);
            $this->message='Change the desired details';
            $this->changeView();
            return;
        }
        $this->entity = (object) $_POST;
        try {
            $this->controlName();
            Coach::changeExisting($this->entity);
            $this->index();
        } catch (Exception $e) {
            $this->message=$e->getMessage();
            $this->changeView();
        }
        $this->entity = (object) $_POST;
        try {
            $this->controlSurname();
            Coach::changeExisting($this->entity);
            $this->index();
        } catch (Exception $e) {
            $this->message=$e->getMessage();
            $this->changeView();
        }
    $this->entity = (object) $_POST;
        try {
            $this->controlNickname();
            Coach::changeExisting($this->entity);
            $this->index();
        } catch (Exception $e) {
            $this->message=$e->getMessage();
            $this->changeView();
        }
    }


    public function delete()
    {
        if(!isset($_GET['id'])){
            $ic = new IndexController();
            $ic->logout();
            return;
        }
        Coach::deleteExisting($_GET['id']);
        header('location: ' . App::config('url') . 'coach/index');
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
    private function changeView()
    {
        $this->view->render($this->viewDir . 'change',[
            'entity'=>$this->entity,
            'message'=>$this->message
        ]);
    }

    private function newView()
    {
        $this->view->render($this->viewDir . 'new',[
            'entity'=>$this->entity,
            'message'=>$this->message
        ]);
    }

    private function control()
    {
        $this->controlName();
        $this->controlSurname();
        $this->controlNickname();
    }

    private function controlName()
    {
        if(strlen(trim($this->entity->name))==0){
            throw new Exception('Name is required');
        }
        if(strlen(trim($this->entity->name))>50){
            throw new Exception('Name is cannot have more than 50 characters');
        }
    }
    private function controlSurname()
    {
        if(strlen(trim($this->entity->surname))==0){
            throw new Exception ('Surname is required');
        }
        if(strlen(trim($this->entity->surname))>50){
            throw new Exception('Surname is cannot have more than 50 characters');
        }
    }
    private function controlNickname()
    {
        if(strlen(trim($this->entity->nickname))==0){
            throw new Exception ('Nickname is required');
        }
        if(strlen(trim($this->entity->nickname))>50){
            throw new Exception('Nickname is cannot have more than 50 characters');
        }
    }
}