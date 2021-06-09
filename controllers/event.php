<?php

require_once "../models/Registration.php";
require_once "../models/Session.php";
require_once "../models/Authentication.php";
require_once "../models/Event.php";
require_once "../variables.php";

Session::appendToHistory();
if (Authentication::isAuth()['auth']) {
    Session::extendValidity();
}


try {
    $bdd = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$reponse = $bdd->query('SELECT * FROM events');


include "../views/event.php";