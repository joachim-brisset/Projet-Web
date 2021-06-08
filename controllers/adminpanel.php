<?php

require_once "../models/Authentication.php";
require_once "../models/Authorization.php";
require_once "../models/Event.php";
require_once "../models/Product.php";
require_once "../models/Registration.php";
require_once "../models/User.php";

Session::appendToHistory();
if (!Authentication::isAuth()['auth']) header('Location: /sign-in') or die;

Session::extendValidity();
Authorization::allow(Authorization::STAFF);
?>
<body>
    <nav>
        <h1><a href="/adminpanel"> Admin Panel </a></h1>
        <ul>
            <li class="nav-link"><a href="/adminpanel/users"> <p>Utilisateurs </p> <img src="/img/arrow.svg"> </a></li>
            <li class="nav-link"><a href="/adminpanel/events"> <p>Evenements</p> <img src="/img/arrow.svg"> </a></li>
            <li class="nav-link"><a href="/adminpanel/products"> <p>Produits</p> <img src="/img/arrow.svg"> </a></li>
            <li class="nav-link"><a href="/adminpanel/budget"> <p>Gestion du budget</p> <img src="/img/arrow.svg"> </a></li>
        </ul>
    </nav>
    <main>
        <?php /*
        <header>
            <p> Utilisateur </p>
        </header>
        <section>
            <table>
                <thead>
                    <th> Pseudo </th>
                    <th> mail </th>
                    <th> Firstname </th>
                    <th> Lastname </th>
                    <th> gender </th>
                    <th> birthday </th>
                    <th> permission ID </th>
                    <th> Creation </th>
                </thead>
                <?php foreach(User::all() as $user): ?>
                <tr>
                    <form>
                        <input hidden name="user_id" value="<?= $user['id']?>">
                        <td> <?= $user['username'] ?> </td>
                        <td> <?= $user['mail'] ?> </td>
                        <td> <?= $user['firstname'] ?> </td>
                        <td> <?= $user['lastname'] ?> </td>
                        <td> <?= $user['gender'] ?> </td>
                        <td> <?= $user['birth_day'] ?> </td>
                        <td> <?= $user['role_id'] ?> </td>
                        <td> <?= $user['create_at'] ?> </td>
                        <td> <button> Edit </button> </td>
                    </form>
                </tr>
                <?php endforeach; ?>
            </table>
        </section> */

        if ($_GET['page'] == 'events'):
            $eventInProgress = Event::inProgress();
            $eventUpComing = Event::soon();
            $eventAll = Event::all();

            require "../views/components/adminpanel/events.php";

        elseif ($_GET['page'] == 'products'):
            $allProducts = Product::all();

            require "../views/components/adminpanel/products.php";
        elseif ($_GET['page'] == 'budget'):
            $eventAll = Event::all();
            $allProducts = Product::all();
            $allUsers = User::all();
            $membre_price = Roles::withRole(Authorization::MEMBER)['price'];
            $staff_price = Roles::withRole(Authorization::STAFF)['price'];
            require "../views/components/adminpanel/budget.php";
        elseif ($_GET['page'] == 'users'):
            $allUsers = User::all();
            require "../views/components/adminpanel/users.php";
        endif; ?>
    </main>
</body>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        color: black;
    }
    a {
        text-decoration: none;
    }

    nav {
        position: absolute;
        max-width: 350px;
        width: 20%;
        min-width: 250px;
        height: 100vh;

        padding-top: 30px;

        background: linear-gradient(35deg, #309dd6, cornflowerblue);
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0,0,0 ,0.5), 0 0 0 2px cadetblue;
        overflow: hidden;
    }
    nav h1 {
        text-align: center;
    }

    nav ul {
        margin-top: 100px;
    }

    .nav-link {
        width: 100%;
        margin: 10px 0;
        padding: 10px 15px;
        list-style: none;
        font-size: 1.8em;
    }
    .nav-link:hover{
        box-shadow: 0 0 5px black;
    }
    .nav-link > a {
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        align-items: center;
    }
    .nav-link > a > img {
        float: right;
    }

    main {
        position: absolute;
        width: 80%;
        max-width: calc(100% - 250px);
        min-width: calc(100% - 350px);
        right: 0;
        height: 100vh;

        padding: 15px;
    }

    header {
        height: 5%;
        width: 100%;
        text-align: center;
    }

    /************** Events ********************/
    section#event-container {
        position: relative;
        display: grid;
        grid-template-rows: 1fr 1fr 2fr 80px;
        grid-template-columns: 3fr 1fr;
        grid-gap: 20px;

        height: 95%;
        width: 100%;
    }

    main section:first-of-type > .container {
        --radius: 10px;
        border-radius: var(--radius);
        background: rgba(0,0,0, 0.1);
        padding: var(--radius);

        box-shadow: 0 0 3px 0 black;
    }
    main section:first-of-type > .container > p.title {
        text-align: center;
    }

    #all-event-container {
        grid-row: 3/4;
        grid-column: 1/3;
    }
    #event-stats {
        grid-row: 1/3;
        grid-column: 2/3;
    }
    #next-event-container {
        grid-row: 2/3;
        grid-column: 1/2;
    }
    #add-event-container {
        grid-row: 4/5;
        grid-column: 1/3;
    }
    .event , .container-header{
        position: relative;
        height: 20px;
        box-sizing: content-box;
        width: 100%;
        overflow-y: hidden;
    }
    .event.expanded {
        height: auto;
    }
    .event > button {
        position: absolute;
        right: 0;
        top: 0;
        width: 20px;
    }

    .ajax-form > * {height: 20px; vertical-align: middle}
    .ajax-form label {
        margin: 0 5px;
    }
    .ajax-form label > img {
        height: 17px;
    }
    input[name=event_name] {
        width: 12.5%;
    }
    input[name=event_place] {
        width: 7.5%;
    }
    input[name=event_start], input[name=event_end] {
        width: 10%;
    }
    input[name=event_desc] {
        width: 30%;
    }
    input[name=event_price], input[name=event_place_number], input[name=event_cost] {
        width: 5%;
    }
    input[type=submit] {
        width: 5%;
    }

    .user-container {
        padding: 0 15px;
        margin-bottom: 10px;
    }
    .user-info > input[type=submit] {
        width: 20px;
    }
    /********************** Users ***********************/

    input[name=user_username], input[name=user_firstname], input[name=user_lastname], input[name=user_mail], input[name=user_gender], input[name=user_birth_day],                   input[name=user_jobs], input[name=user_street_number], input[name=user_street], input[name=user_cp], input[name=user_city], input[name=user_country],                   input[name=user_role_id], select[name=user_role_id], select[name=user_gender] {
        width: 6.6%;
    }
            
    #add-user-container {
        margin-top: 20px;
    }

    /********************* Products *********************/
    section#product-container {
        display: grid;
        position: relative;
        grid-template-rows: 1fr 80px;
        grid-template-columns: 80%;
        grid-gap: 20px;

        height: 95%;
        width: 100%;
    }

    input[name=product_name] {
        width: 15%
    }
    input[name=product_price], input[name=product_stocks], input[name=product_initial_stock], input.sold {
        width: 5%
    }


</style>