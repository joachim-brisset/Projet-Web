<?php

require_once "../models/me_sql.php";

if (isset($_POST['current_mail'])) {
    $msg = change_email();
}


include "../views/change_email.php";