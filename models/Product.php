<?php

require_once "../variables.php";

class Product {

    public static function all() {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $req = $db->prepare("SELECT * FROM products");
        $req->setFetchMode(PDO::FETCH_ASSOC);

        $req->execute();
        return $req->fetchAll();
    }
}