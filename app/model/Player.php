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
    public static function addNew($player)
    {
        $connection = DB::getInstance();
        $expression=$connection->prepare('

            insert into player (name,surname,country,nickname,lane)
            values(:name,:surname,:country,:nickname,:lane)
        ');
        $expression->execute((array)$player);
        
    }
}