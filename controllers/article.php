<?php

require_once "../variables.php";

if (Authentication::isAuth()['auth']) Session::extendValidity();

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