<?php

session_start();

//echo __DIR__;
define('BP',__DIR__ . DIRECTORY_SEPARATOR);

//echo BP;

$path=implode(
    PATH_SEPARATOR,
    [
        BP . 'model',
        BP . 'controller'

    ]

);

    set_include_path ($path);

    spl_autoload_register(function($class){
        $path = explode(PATH_SEPARATOR,get_include_path());
        foreach ($path as $p){
            if (file_exists($p . DIRECTORY_SEPARATOR . $class . '.php')){
                include $p . DIRECTORY_SEPARATOR . $class . '.php';
            }
        }
    });

    App::start();

?>