<?php

$dev=$_SERVER['REMOTE_ADDR']==='127.0.0.1' ? true : false;
if($dev){
    $database=[
        'server'=>'localhost',
        'database'=>'edunovapp22',
        'user'=>'edunova',
        'password'=>'edunova'
        ]
    ];  
}else{
    $base=[
        'server'=>'localhost',
        'database'=>'xxxxx',
        'user'=>'xxxxx',
        'password'=>'xxxxx'
    ];
}
return [
    'url'=>'http://polaznik26.edunova.hr/',
    'AppName'=>'LEC'
    'database'=>$database
]