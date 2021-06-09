<?php 

require_once "../models/Session.php";
require_once "../models/Authentication.php";
require_once "../models/me_sql.php";


if (Authentication::isAuth()['auth']) {
    Session::extendValidity();
} else {
    header("Location: /sign-in") or die;
}


$_SESSION['data_error'] = ["", "", "", "", "", "", "", "", "", ""];

if (isset($_POST['confirm'])) {
    control_data();
    if ($_SESSION['data_error'] == ["", "", "", "", "", "", "", "", "", ""]) {
        complete_data();
        header("Location: /me");
    }
}

$mail = get_mail();
$user = get_infos();


include "../views/complete_data.php";