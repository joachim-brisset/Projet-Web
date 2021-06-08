<?php

require_once "../variables.php";

class Event {

    public static function inProgress(int $limit = 0) {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $req = $db->prepare("SELECT * FROM events WHERE start_at < CURRENT_DATE AND end_at > CURRENT_DATE " . ($limit != 0 ? "LIMIT :limit" : ""));
        $req->setFetchMode(PDO::FETCH_ASSOC);
        if ($limit) $req->bindValue( ":limit", $limit, PDO::PARAM_INT);

        $req->execute();
        return $req->fetchAll();
    }

    public static function soon(int $days = 7, int $limit = 0) {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $req = $db->prepare("SELECT * FROM events WHERE start_at < CURRENT_DATE + INTERVAL :days DAY AND start_at > CURRENT_DATE" . ($limit != 0 ? "LIMIT :limit" : ""));
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req->bindValue( ":days", $days, PDO::PARAM_INT);
        if ($limit) $req->bindValue( ":limit", $limit, PDO::PARAM_INT);

        $req->execute();
        return $req->fetchAll();
    }

    public static function all() {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $req = $db->prepare("SELECT * FROM events");
        $req->setFetchMode(PDO::FETCH_ASSOC);

        $req->execute();
        return $req->fetchAll();
    }

    public static function update(array $uniqueKey, array $values)
    {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $updateCondition = [];
        foreach ($uniqueKey as $key => $value) {
            array_push($updateCondition, "`$key` = '" . addslashes($value) . "'");
        }
        $updateValue = [];
        foreach ($values as $key => $value) {
            array_push($updateValue, "`$key` = '" . addslashes($value) . "'");
        }

        $req = $db->prepare("UPDATE events SET " . implode(',', $updateValue) . " WHERE " . implode(',', $updateCondition)  );

        /* not working
        $req->bindValue(':updateCondition', implode(',', $updateCondition), PDO::PARAM_STR);
        $req->bindValue(':updateValue', implode(',', $updateValue), PDO::PARAM_STR);
        */

        return $req->execute();
    }

    public static function withID(int $id)
    {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $req = $db->prepare("SELECT * FROM events WHERE id = :id");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req->bindParam(":id", $id, PDO::PARAM_INT);

        $req->execute();
        return $req->fetch();
    }

    public static function add(array $params)
    {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $keys = []; $values= [];
        foreach ($params as $key => $value) {
            array_push($keys, $key);
            array_push($values, "'".addslashes($value)."'");
        }

        $req = $db->prepare("INSERT INTO events (". implode(',', $keys) .") VALUES (". implode(',', $values) .")");
        $req->setFetchMode(PDO::FETCH_ASSOC);

        /* not working
        $req->bindValue(":keys", implode(',', $keys) , PDO::PARAM_STR);
        $req->bindValue(":values", implode(',', $values) , PDO::PARAM_STR);
        */


        return $req->execute();
    }

    public static function delete(int $id)
    {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);
        $req = $db->prepare("DELETE FROM events WHERE id = :id");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req->bindParam(":id", $id, PDO::PARAM_INT);
        return $req->execute();
    }


}