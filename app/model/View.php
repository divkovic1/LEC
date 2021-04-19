<?php

class View 
{
    private $template;

    public function __construct($template='template')
    {
        $this->$template=$template;
    }

    public function render($renderpage, $parameters=[])
    {
        print_r ($parameters);
        ob_start();
        extract($parameters);
        include BP . 'view' . DIRECTORY_SEPARATOR . 
        $renderpage . '.phtml';
        $content = ob_get_clean();
        include BP_APP . 'view' . DIRECTORY_SEPARATOR . 
        $this->template . '.phtml';
    }
}