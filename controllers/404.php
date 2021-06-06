<?php

require_once "../models/Session.php";
require_once "../models/Authentication.php";

if (Authentication::isAuth()['auth']) Session::extendValidity();

include "../views/404.php";
