<?php

require_once "../models/Authentication.php";
require_once "../models/Authorization.php";
require_once "../models/Event.php";
require_once "../models/Product.php";

Session::appendToHistory();
if (!Authentication::isAuth()['auth']) header('Location: /sign-in') or die;

Session::extendValidity();
Authorization::allow(Authorization::STAFF);
?>

<script defer src="/js/adminpanel-event.js"> </script>
<body>
    <nav>
        <h1><a href="/adminpanel"> Admin Panel </a></h1>
        <ul>
            <li class="nav-link"><a href="/adminpanel/users"> <p>Utilisateurs </p> <img src="/img/arrow.svg"> </a></li>
            <li class="nav-link"><a href="/adminpanel/events"> <p>Evenements</p> <img src="/img/arrow.svg"> </a></li>
            <li class="nav-link"><a href="/adminpanel/products"> <p>Produits</p> <img src="/img/arrow.svg"> </a></li>
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
        width: 350px;
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
        left: 350px;
        right: 0;
        height: 100vh;

        padding: 15px;
    }

    header {
        height: 5%;
        width: 100%;
        text-align: center;
    }

    section#event-container {
        position: relative;
        display: grid;
        grid-template-rows: 1fr 1fr 2fr 80px;
        grid-template-columns: 3fr 1fr;
        grid-gap: 20px;

        height: 95%;
        width: 100%;
    }

    #event-container > .container {
        --radius: 10px;
        border-radius: var(--radius);
        background: rgba(0,0,0, 0.1);
        padding: var(--radius);
    }
    #event-container > .container > p {
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

    .event {
        box-sizing: content-box;
        width: 100%;
    }
    .event > p {
        display: inline-block;
    }

    input {height: 20px}
    input[name=event_name],input[name=event_place], input[name=event_start], input[name=event_end] {
        width: 12.5%;
    }
    input[name=event_desc] {
        width: 30%;
    }
    input[name=event_price], input[name=event_place_number] {
        width: 5%;
    }
    input[type=submit] {
        width: 7%;
    }


    #event-editor {
        position: absolute;
        background: rgba(176, 176, 176, 0.7);
        top: 10%;
        bottom: 10%;
        right: 10%;
        left: 10%;

        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 0 10px black;
    }
    /*
    table {
        width: 100%;

        border-radius: 5px;
        padding: 5px;
    }

    tr:nth-child(even) {
        background: #cad4de;
    }
    tr:nth-child(odd) {
        background: aliceblue;
    }
    */
</style>