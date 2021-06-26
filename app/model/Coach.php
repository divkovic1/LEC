<?php

class Coach
{
    public static function load($id)
    {
        $connection = DB::getInstance();
        $expression=$connection->prepare('
            select a.id,a.name,a.surname,a.nickname,a.country
            b.name from coach a
            inner join organization b on a.organization =b.id
            where a.id=:id;
        ');
        $expression->execute(['id'=>$id]);
        return $id->fetch();
    }
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
    public static function changeExisting($entity)
    {
        $connection = DB::getInstance();
        $connection->beginTransaction();
        $expression=$connection->prepare('
            select organization from coach where id=:id
        ');
        $expression->execute(['id'=>$entity->id]);
        $idCoach=$expression->fetchColumn();

        $expression=$connection->prepare('
            update coach
            set name=:name, surname=:surname,country=:country,nickname=:nickname
            where id=:id
        ');
        $expression->execute([
            'name'=>$entity->name,
            'surname'=>$entity->surname,
            'country'=>$entity->country,
            'nickname'=>$entity->nickname,
            'id'=>$idCoach
        ]);
        
        $connection->commit();
    }


    public static function deleteExisting($id)
    {
        $connection = DB::getInstance();
        $connection->beginTransaction();
        $expression=$connection->prepare('
            select organization from coach where id=:id
        ');
        $expression->execute(['id'=>$id]);
        $idOrganization=$expression->fetchColumn();

        $expression=$connection->prepare('
            delete from coach where id=:id
        ');
        $expression->execute(['id'=>$id]);

        $expression=$connection->prepare('
            delete from organization where id=:id
        ');
        $expression->execute(['id'=>$idOrganization]);

        $connection->commit();
    }
}