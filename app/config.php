<?php

$dev=$_SERVER['REMOTE_ADDR']==='127.0.0.1' ? true : false;
if($dev){
    $database=[
        'server'=>'localhost',
        'database'=>'lec',
        'user'=>'edunova',
        'password'=>'edunova'
        
    ];  
}else{
    $base=[
        'server'=>'localhost',
        'database'=>'nika_LEC',
        'user'=>'nika_Dominik',
        'password'=>'edunova123.'
    ];
}
return [
    'url'=>'http://polaznik26.edunova.hr/',
    'AppName'=>'LEC',
    'database'=>$database
];