<?php
require_once "../models/Authentication.php";
require_once "../models/Session.php";
Session:: appendToHistory();;
if (!Authentication :: isAuth()["auth"]){
    header("Location: /sign-in");
}
Session:: extendValidity();
include "../views/cart.php";