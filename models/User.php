<?php
require_once "../Variables.php";

class User
{
    /**
     * <p> Check if a user exist with this $id</p>
     * @param $id <p> the id to check </p>
     * @return bool <p> Return true if exist and false otherwise </p>
     */
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

    /**
     * <p> Get all info about the user associated with the $mail if it exist </p>
     * @param $mail <p> mail to match </p>
     * @return mixed|null <p> return all info about the user if it exist or null otherwise
     */
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

    /**
     * <p> Create a new entry in user table of the database </p>
     * @param $mail <p> mail of the user </p>
     * @param $password <p> password of the user </p>
     * @return string <p> Return the user id</p>
     */
    static function create($mail, $password) {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $req = $db->prepare("INSERT INTO users (`mail`,`password`) VALUES (:cmail,:password);");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req->bindValue( ":cmail", $mail, PDO::PARAM_STR);
        $req->bindValue( ":password", password_hash($password, PASSWORD_DEFAULT ), PDO::PARAM_STR);

        $req->execute();
        return $db->lastInsertId();
    }

    /**
     * <p> Get all info about the user associated to the $id</p>
     * @param int $id <p> the to return user id </p>
     * @return mixed <p> Associative array about the user. </>
     */
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

    /**
     * <p> Get all info about all user. </p>
     * @return array <p> return a array of associative array about the user </p>
     */
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
    
    public static function add(array $params)
    {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $keys = []; $values= [];
        foreach ($params as $key => $value) {
            array_push($keys, $key);
            array_push($values, "'".addslashes($value)."'");
        }

        $req = $db->prepare("INSERT INTO users (". implode(',', $keys) .") VALUES (". implode(',', $values) .")");
        $req->setFetchMode(PDO::FETCH_ASSOC);

        /* not working
        $req->bindValue(":keys", implode(',', $keys) , PDO::PARAM_STR);
        $req->bindValue(":values", implode(',', $values) , PDO::PARAM_STR);
        */

        return $req->execute();
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

        $req = $db->prepare("UPDATE users SET " . implode(',', $updateValue) . " WHERE " . implode(',', $updateCondition)  );

        /* not working
        $req->bindValue(':updateCondition', implode(',', $updateCondition), PDO::PARAM_STR);
        $req->bindValue(':updateValue', implode(',', $updateValue), PDO::PARAM_STR);
        */

        $req->execute();
        return $req->queryString;
    }

    public static function delete(int $id)
    {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);
        $req = $db->prepare("DELETE FROM users WHERE id = :id");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req->bindParam(":id", $id, PDO::PARAM_INT);
        return $req->execute();
    }
}