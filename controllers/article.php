<?php

require_once "../variables.php";
require_once "../models/Authentication.php";
require_once "../models/User.php";

if (Authentication::isAuth()['auth']){
    if(!User::isComplete($_SESSION[Session::ID])) header('Location: /complete_data');
    Session::extendValidity();
}

try {
    $bdd = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$reponse = $bdd->prepare('SELECT * FROM articles WHERE id=:id');

$reponse->bindParam(':id', $_GET["eventid"], PDO::PARAM_INT);

$reponse->execute();

$item = $reponse->fetch();


include "../views/article.php";