<?php

class Player
{

    public static function load($id)
    {
        $connection = DB::getInstance();
        $expression=$connection->prepare('
            select *  from player where id=:id
        ');
        $expression->execute(['id'=>$id]);
        return $expression->fetch();
    }

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

    public static function changeExisting($player)
    {
        $connection = DB::getInstance();
        $expression=$connection->prepare('
            update player set
            name=:name,surname=:surname,
            country=:country,nickname=:nickname,
            lane=:lane
            where id=:id
        ');
        $expression->execute((array)$player);
    }
}