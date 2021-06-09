<?php
require_once "../models/Authentication.php";
require_once "../models/Session.php";
require_once "../models/User.php";

$lastUrl = Session::popHistory();

Session:: appendToHistory();;
if (!Authentication :: isAuth()["auth"]){
    header("Location: /sign-in");
}
if(!User::isComplete($_SESSION[Session::ID])) header('Location: /complete_data');
Session:: extendValidity();

include "../views/cart.php";