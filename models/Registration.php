<?php

require_once "../variables.php";

class Registration {

    public static function with(array $where) {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $temp = [];
        foreach ($where as $key => $value) {
            array_push($temp, "$key='$value'");
        }
        $cond = implode(" AND ",$temp);

        $req = $db->prepare("SELECT * FROM registration " . (!empty($where) ? "WHERE $cond" : "") );
        $req->setFetchMode(PDO::FETCH_ASSOC);
        /*not working
        $req->bindValue( ":cond", $cond, PDO::PARAM_STR);
        */

        $req->execute();
        return $req->fetchAll();
    }

    public static function unregister(int $event_id,int $user_id)
    {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $req = $db->prepare("DELETE FROM registration WHERE event_id=:event_id AND user_id=:user_id");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req->bindValue( ":event_id", $event_id, PDO::PARAM_INT);
        $req->bindValue( ":user_id", $user_id, PDO::PARAM_INT);


        return $req->execute();
    }

    public static function register($event_id, $user_id)
    {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $req = $db->prepare("INSERT INTO registration (user_id,event_id) VALUES (:user_id,:event_id)");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req->bindValue( ":event_id", $event_id, PDO::PARAM_INT);
        $req->bindValue( ":user_id", $user_id, PDO::PARAM_INT);


        return $req->execute();
    }
}
