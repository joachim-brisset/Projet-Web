<?php

require_once "../variables.php";

class Product {

    /**
     * <p> Get all info about all product. </p>
     * @return array <p> return a array of associative array about the product </p>
     */
    public static function all() {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $req = $db->prepare("SELECT * FROM products");
        $req->setFetchMode(PDO::FETCH_ASSOC);

        $req->execute();
        return $req->fetchAll();
    }

    /**
     * <p> Create a new entry in the product table of the database </p>
     * @param array $params <p> Associative array of info. ALl keys must be table column </p>
     * @return bool Return true if creation is successful and false otherwise
     */
    public static function add(array $params)
    {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $keys = []; $values= [];
        foreach ($params as $key => $value) {
            array_push($keys, $key);
            array_push($values, "'".addslashes($value)."'");
        }

        $req = $db->prepare("INSERT INTO products (". implode(',', $keys) .") VALUES (". implode(',', $values) .")");
        $req->setFetchMode(PDO::FETCH_ASSOC);

        /* not working
        $req->bindValue(":keys", implode(',', $keys) , PDO::PARAM_STR);
        $req->bindValue(":values", implode(',', $values) , PDO::PARAM_STR);
        */

        return $req->execute();
    }

    /**
     * <p> Get all info about the product associated to the $id</p>
     * @param int $id <p> the to return product id </p>
     * @return mixed <p> Associative array about the product. All keys are table column </>
     */
    public static function withID($id)
    {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $req = $db->prepare("SELECT * FROM products WHERE id = :id");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req->bindParam(":id", $id, PDO::PARAM_INT);

        $req->execute();
        return $req->fetch();
    }

    /**
     * <p> Update en entry in the product table of the database </p>
     * @param array $uniqueKey <p> an associative array of unique key or pair. Keys must be database column</p>
     * @param array $values <p> an associative of key and value to update. Keys must be database column</p>
     * @return bool Return true if update is successful and false otherwise
     */
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

        $req = $db->prepare("UPDATE products SET " . implode(',', $updateValue) . " WHERE " . implode(',', $updateCondition)  );

        /* not working
        $req->bindValue(':updateCondition', implode(',', $updateCondition), PDO::PARAM_STR);
        $req->bindValue(':updateValue', implode(',', $updateValue), PDO::PARAM_STR);
        */

        return $req->execute();
    }

    /**
     * <p> Create a new entry in the event table of the database </p>
     * @param int $id <p> the to delete event id </p>
     * @return bool Return true if creation is successful and false otherwise
     */
    public static function delete(int $id)
    {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);
        $req = $db->prepare("DELETE FROM products WHERE id = :id");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req->bindParam(":id", $id, PDO::PARAM_INT);
        return $req->execute();
    }
}