<?php
/**
 * $msg is the message error to be displayed.
 */


require_once "../models/Authentication.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ((isset($_POST["pseudo"]) && !empty($_POST["pseudo"])) && (isset($_POST["pass"]) && !empty($_POST["pass"])) &&(isset($_POST["confpass"]) && !empty($_POST["confpass"])) ) {
        if ($_POST["confpass"] == $_POST["pass"]) {
            $registration = Authentication::register($_POST['pseudo'], $_POST['pass']);

            if ($registration['auth']) {
                header("Location: ". (Session::popHistory() ?? '/'));
                die;
            }
            switch ($registration['error']) {
                case Authentication::NOT_CREATED: $msg = "user not created please retry"; break;
                case Authentication::ALREADY_REGISTERED: $msg = "user already exist"; break;
            }
        } else
            $msg = "password are not the same";
    } else
        $msg = "wrong argument please pass a pseudo, a pass and a confpass";
}


if (Authentication::isAuth()['auth']) header("Location: /") or die;
require "../views/sign-up.php";