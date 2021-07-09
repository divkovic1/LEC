<?php

class OrganizationController extends AuthorizationController
{
    private $viewDir = 'private'
                        . DIRECTORY_SEPARATOR
                        . 'organization'
                        . DIRECTORY_SEPARATOR;

    private $entity=null;
    private $message='';

    public function index()
    {
        $this->view->render($this->viewDir . 'index',[
            'entities'=>Organization::loadEverything()
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
        Organization::addNew($this->entity);
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
        $this->entity = Organization::load($_GET['id']);
        $this->message='Change the desired details';
        $this->changeView();
        return;
    }
    $this->entity = (object) $_POST;
    try {
        $this->controlName();
        Organization::changeExisting($this->entity);
        $this->index();
    } catch (Exception $e) {
        $this->message=$e->getMessage();
        $this->changeView();
    }
}

public function delete()
{
    if(!isset ($_GET['id'])){
        $ic = new IndexController();
        $ic->logout();
        return;
    }
    Organization::deleteExisting($_GET['id']);
    header('location: ' . App::config('url') . 'organization/index');
}

private function newEntity()
{
    $this->entity= new stdClass();
    $this->entity->name='';
    $this->entity->twitter='';
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
    $this->view->render($this->viewDir. 'new',[
        'entity'=>$this->entity,
        'message'=>$this->message
    ]);
}

private function control()
{
    $this->controlNameTwitter();
}

private function controlNameTwitter()
{
    $this->controlName();
    $this->controlTwitter();
}

private function controlName()
{
    if(strlen(trim($this->entity->name))==0){
        throw new Exception('The name is required');
    }

    if(strlen(trim($this->entity->name))>50){
        throw new Exception('The name is too long');
        }
    }

    private function controlTwitter()
    {
        if(strlen(trim($this->entity->twitter))==0){
            throw new Exception('The twitter handle is required');
        }
    
        if(strlen(trim($this->entity->twitter))>50){
            throw new Exception('The handle is too long');
      }
    }
}