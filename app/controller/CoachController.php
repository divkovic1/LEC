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
}