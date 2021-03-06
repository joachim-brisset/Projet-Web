<?php
require_once "../models/Roles.php";
require_once "../models/Authentication.php";
require_once "../models/User.php";

if (Authentication::isAuth()['auth']){
    if(!User::isComplete($_SESSION[Session::ID])) header('Location: /complete_data');
    Session::extendValidity();
}

try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=assos;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
    die('Erreur : ' . $e->getMessage());
    }

$reponse = $bdd->prepare('SELECT * FROM users WHERE id=:id   ');

$reponse->bindParam(':id',$_GET["userid"],PDO::PARAM_INT);

$reponse -> execute();

$item = $reponse -> fetch();

$role = Roles::withID($item["role_id"])["role"];

include "../views/result_user.php";


