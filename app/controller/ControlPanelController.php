<?php

class ControlPanelController extends AuthorizationController
{
    public function index()
    {
        $this->view->render('private' . DIRECTORY_SEPARATOR . 'controlpanel');
    }
}