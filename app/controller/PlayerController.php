<?php

class PlayerController extends AuthorizationController

{
    private $viewDir = 'private'
                        . DIRECTORY_SEPARATOR
                        . 'player'
                        . DIRECTORY_SEPARATOR;

    public function index()
    {
        $this->view->render($this->viewDir . 'index');
    }
}