<?php

require_once "../models/Authentication.php";
require_once "../models/Authorization.php";
require_once "../models/Event.php";
require_once "../models/Product.php";
require_once "../models/Registration.php";
require_once "../models/User.php";
require_once "../models/Roles.php";

Session::appendToHistory();
if (!Authentication::isAuth()['auth']) header('Location: /sign-in') or die;

Session::extendValidity();
Authorization::allow(Roles::STAFF);

switch($_GET['page']) {
    case "events":
        $eventInProgress = Event::inProgress();
        $eventUpComing = Event::soon();
        $eventAll = Event::all();

        $mainContent = file_get_contents("../views/components/adminpanel/events.php");
        break;

    case "products":
        $allProducts = Product::all();

        $mainContent = file_get_contents("../views/components/adminpanel/products.php");
        break;

    case "news":
        $mainContent = file_get_contents("../views/components/adminpanel/news.php");
        break;

    case 'budget':
        $eventAll = Event::all();
        $allProducts = Product::all();
        $allUsers = User::all();
        $membre_price = Roles::withRole(Roles::MEMBER)['price'];
        $staff_price = Roles::withRole(Roles::STAFF)['price'];

        $mainContent = file_get_contents("../views/components/adminpanel/budget.php");
        break;

    default: ob_start();?>
            <div id="title-container">
                <h1 class="title"> Bienvenue sur l'AdminPanel </h1>
                <hr>
                <h2 class="title"> Veuillez choisir un sous-menu pour commencer à administrer</h2>
            <div>
        <?php $mainContent = ob_get_contents();
        ob_end_clean();
}



include "../views/adminpanel.php";