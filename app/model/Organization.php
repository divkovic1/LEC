<?php

class Organization

{
    public static function load($id)
    {
        $connection = DB::getInstance();
        $expression=$connection->prepare('
        select * from organization where id=:id      
        ');

        $expression->execute(['id'=>$id]);
        return $id->fetch();

    }

    public static function loadEverything()
    {
        $connection = DB::getInstance();
        $expression=$connection->prepare('
          select a.id, a.name, a. twitter, count(b.id) as gameorg
          from organization a
          inner join game b on a.id=b.organization
          inner join matchday c on c.id=b.matchday  
        ');

        $expression->execute();
        return $expression->fetchAll();


    }

    public static function addNew($entity)
    {
        $connection = DB::getInstance();
        $expression=$connection->prepare('

            insert into organization(name, twitter) values
            (:name, :twitter)
        ');
        $expression->execute([
            'name'=>$entity->name,
            'twitter'=>$entity->twitter
        ]);

        $connection->commit();
        
    }

    public static function changeExisting($entity)
    {
        $connection = DB::getInstance();
        $connection->beginTransaction();
        $expression=$connection->prepare('
            select name from organization where id=:id
        ');
        $expression->execute(['id'=>$entity->id]);
        $idOrganization=$expression->fetchColumn();

        $expression=$connection->prepare('
            update organization
            set name=:name, twitter=:twitter
            where id=:id
        ');
        $expression->execute([
            'name'=>$entity->name,
            'twitter'=>$entity->twitter,
            'id'=>$idOrganization
        ]);
        
        $connection->commit();
    }

    public static function deleteExisting($id)
    {
        $connection = DB::getInstance();
        $connection->beginTransaction();
        $expression=$connection->prepare('
            select name from organization where id=:id
        ');
        $expression->execute(['id'=>$id]);
        $idOrganization=$expression->fetchColumn();

        $expression=$connection->prepare('
            delete from organization where id=:id
        ');
        $expression->execute(['id'=>$id]);

        $expression=$connection->prepare('
            delete from organization where id=:id
        ');
        $expression->execute(['id'=>$idOrganization]);

        $connection->commit();
    }   
}