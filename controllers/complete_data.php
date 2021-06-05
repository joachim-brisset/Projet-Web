<?php 

require_once "../models/Session.php";
require_once "../models/Authentication.php";

Session::appendToHistory();
if (Authentication::isAuth()['auth']) {
    Session::extendValidity();
} else {
    header("Location: /sign-in") or die;
}

include "../views/complete_data.php";