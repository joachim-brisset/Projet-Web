<?php
require_once "../Variables.php";

class User
{
    static function existWithID($id) {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $request = $db->prepare("SELECT * FROM `Users` WHERE `id` = :id");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        $request->bindValue(':id', $id, PDO::PARAM_INT);

        $request->execute();
        $result = $request->fetchAll();

        if(sizeof($result) > 1) throw new \http\Exception\RuntimeException("Multiple user with same ID");
        if(sizeof($result) == 0) return false;

        return true;
    }

    static function withMail($mail) {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $req = $db->prepare("SELECT * FROM users WHERE mail = :cmail");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req->bindValue( ":cmail", $mail, PDO::PARAM_STR);

        $req->execute();
        $result = $req->fetchAll();

        if(sizeof($result) > 1) throw new \http\Exception\RuntimeException("Multiple user with same mail");
        if(sizeof($result) == 0) return null;

        return $result[0];
    }

    static function create($mail, $password) {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $req = $db->prepare("INSERT INTO users (`mail`,`password`) VALUES (:cmail,:password);");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req->bindValue( ":cmail", $mail, PDO::PARAM_STR);
        $req->bindValue( ":password", password_hash($password, PASSWORD_DEFAULT ), PDO::PARAM_STR);

        $req->execute();
        return $db->lastInsertId();
    }

    public static function withID($id)
    {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $req = $db->prepare("SELECT * FROM users WHERE id = :cid");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req->bindValue( ":cid", $id, PDO::PARAM_INT);

        $req->execute();
        $result = $req->fetchAll();

        if(sizeof($result) > 1) throw new \http\Exception\RuntimeException("Multiple user with same ID"); /* impossible normalement */
        if(sizeof($result) == 0) return null;

        return $result[0];
    }

    public static function all()
    {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $req = $db->prepare("SELECT * FROM users");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req->execute();
        $result = $req->fetchAll();

        if(sizeof($result) == 0) return null;

        return $result;
    }
}