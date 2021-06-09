<?php

require_once "../models/me_sql.php";
require_once "../models/User.php";

Session::appendToHistory();
if (Authentication::isAuth()['auth']) {
    if(!User::isComplete($_SESSION[Session::ID])) header('Location: /complete_data');
    Session::extendValidity();
} else {
    header("Location: /sign-in") or die;
}

if (isset($_POST['current_mail'])) {
    $msg = change_email();
}


include "../views/change_email.php";