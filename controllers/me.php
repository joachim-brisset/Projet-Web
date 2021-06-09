<?php 

require_once "../models/Session.php";
require_once "../models/Authentication.php";
include "../models/me_sql.php";

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_start();

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

$mail = get_mail();
$user = get_infos();
$role = get_role();

include "../views/me.php";