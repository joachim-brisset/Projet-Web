<?php

require_once "../models/Session.php";
require_once "../models/Authentication.php";
require_once "../models/User.php";

Session::appendToHistory();
if (Authentication::isAuth()['auth']){
    if(!User::isComplete($_SESSION[Session::ID])) header('Location: /complete_data');
    Session::extendValidity();
}

include "../views/store.php";