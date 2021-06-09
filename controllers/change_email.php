<?php

require_once "../models/me_sql.php";

Session::appendToHistory();
if (Authentication::isAuth()['auth']) {
    Session::extendValidity();
} else {
    header("Location: /sign-in") or die;
}

if (isset($_POST['current_mail'])) {
    $msg = change_email();
}


include "../views/change_email.php";