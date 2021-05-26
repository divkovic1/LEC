<?php

class Player
{

    public static function loadEverything()
    {
        $connection = DB::getInstance();
        $expression=$connection->prepare('
        
                select * from player
        ');
        $expression->execute();
        return $expression->fetchAll();
    }
}