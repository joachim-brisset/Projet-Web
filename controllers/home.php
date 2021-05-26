<?php

require_once "../models/Session.php";
require_once "../models/Authentication.php";

Session::appendToHistory();
if (Authentication::isAuth()['auth']) Session::extendValidity();

include "../views/home.php";