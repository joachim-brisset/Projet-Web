<?php 

require_once "../variables.php";

 class Roles
{

     const MEMBER = 'membre'; /** @var string <p> represent member Role name</p> */
     const STAFF = 'staff'; /** @var string <p> represent staff Role name</p> */
     const STAFF2 = 'staff2'; /** @var string <p> represent staff2 Role name</p> */


     /**
      * <p> Search in database the role with $role name and return all information about it</p>
      * @param string $role <p> role name to search </p>
      * @return mixed|null <p> return an associative array about the role or null if no role was found
      */
    public static function withRole(string $role)
    {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $req = $db->prepare("SELECT * FROM roles WHERE role = :role");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req->bindValue( ":role", $role, PDO::PARAM_STR);

        $req->execute();
        $result = $req->fetchAll();

        if(sizeof($result) > 1) throw new \http\Exception\RuntimeException("Multiple user with same role");
        if(sizeof($result) == 0) return null;

        return $result[0];
    }

     /**
      * <p> Search in database the role with $role_id id and return all information about it</p>
      * @param string $role_id <p> role id to search </p>
      * @return mixed|null <p> return an associative array about the role or null if no role was found
      */
    public static function withID($role_id)
    {
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $req = $db->prepare("SELECT * FROM roles WHERE id = :id");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req->bindValue( ":id", $role_id, PDO::PARAM_INT);

        $req->execute();
        $result = $req->fetchAll();

        if(sizeof($result) > 1) throw new \http\Exception\RuntimeException("Multiple user with same ID"); /* impossible normalement */
        if(sizeof($result) == 0) return null;

        return $result[0];
    }
}