<?php

require_once "../models/Session.php";
require_once "../models/Authentication.php";
require_once "../models/User.php";

Session::appendToHistory();
if (Authentication::isAuth()['auth']){
    if(!User::isComplete($_SESSION[Session::ID])) header('Location: /complete_data');
    Session::extendValidity();
}

if ($_GET["product_id"] == "1") {
    $img1 = "../img/qdqzdqdqzdqz.png";
    $img2 = "../img/qdqzdqdqzdqz.png";
} else if ($_GET["product_id"] == "2") {
    $img1 = "/img/balle-lakers.jpeg";
    $img2 = "/img/balle-lakers.jpeg";
} else if ($_GET["product_id"] == "3") {
    $img1 = "../img/panier.jpeg";
    $img2 = "../img/panier.jpeg";
}

require "../views/product.php";