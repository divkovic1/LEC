<?php

class Coach
{
    public static function loadEverything()
    {
        $connection = DB::getInstance();
        $expression=$connection->prepare('
        
        select a.*,count(b.coach) as coachorg
                from coach a
                left join organization b on b.id=a.coach
                group by a.name,a.surname,
                a.nickname,a.country;

        ');
        $expression->execute();
        return $expression->fetchAll();
    }


    public static function addNew($entity)
    {
        $connection = DB::getInstance();
        $connection->beginTransaction();
        $expression=$connection->prepare('
        
            insert into coach
            (name,surname,nickname,country) values
            (:name, :surname, :nickname, :country)
        
        ');
        $expression->execute([
            'name'=>$entity->name,
            'surname'=>$entity->surname,
            'nickname'=>$entity->nickname,
            'country'=>$entity->country
        ]);
        $connection->commit();
    }
}