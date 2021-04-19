<?php

class IndexController extends Controller
{
    public function index()
    {
        $this->view->render('index',[]
            'result'=>2+2,
            'second'='ttt'
        ]
    }

    public function second()
    {
        $this->view->render('second');
    }
}