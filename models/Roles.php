<?php class Roles
{
    public static function withRole($role)
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