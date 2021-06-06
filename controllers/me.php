<?php 

require_once "../models/Session.php";
require_once "../models/Authentication.php";

session_start();

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    $_SESSION = [];
    session_regenerate_id(true);
    header('Location: /');
    die;
}

Session::appendToHistory();
if (Authentication::isAuth()['auth']) {
    Session::extendValidity();
} else {
    header("Location: /sign-in") or die;
}

include "../views/me.php";