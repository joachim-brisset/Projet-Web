<?php
/**
 * $msg is the message error to be displayed.
 */

require_once "../models/Authentication.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if( (isset($_POST["pseudo"]) && !empty($_POST["pseudo"])) && (isset($_POST["pass"]) && !empty($_POST["pass"])) ) {
        $auth = Authentication::auth( $_POST["pseudo"], $_POST["pass"]);

        if ($auth['auth']) {
            header("Location: ". (Session::popHistory() ?? '/'));
            die;
        }
        switch ($auth['error']) {
            case Authentication::INVALID_USER: $msg = "invalid mail"; break;
            case Authentication::INVALID_PASS: $msg = "invalid pass"; break;
        }
    } else $msg = "You must pass a user and password";
}

$auth = Authentication::isAuth();
if($auth['auth']){ header("Location: /") or die; }
if($auth['error'] == Authentication::AUTH_EXPIRED) $msg = "Session expired";

require "../views/sign-in.php";