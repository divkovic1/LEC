<?php

class App
{
    public static function start()
    {
        $route = Request::getRoute();
        $parts=explode('/',$route);
        $class='';
        if(!isset($parts[1]) || $parts[1]==''){
            $class='Index';
            }else{
                $class=ucfirst($parts[1]);
            }
            $class.='Controller';

            $function='';
            if(!isset($parts[2]) || $parts[2]==''){
                $function='index';
            }else{
                $function=$parts[2];
            }

            if(class_exists($class) && method_exists($class,$function)){
                $instance=new $class();
                $instance->$function();
            }else{
                echo 'Cannot find what you are looking for' . $class . '->' . $function;
            }
    }

    
public static function config($key)
    {
    $config=include BP_APP . 'config.php';
    return $config[$key];
    }

}

