<?php

require_once "../models/me_sql.php";

if (isset($_POST['current_password'])) {
    $msg = change_password();
}

include "../views/change_password.php";