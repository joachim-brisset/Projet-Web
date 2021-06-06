<?php

require_once "../models/Authentication.php";
require_once "../models/Authorization.php";
require_once "../models/Event.php";

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
        </section> */?>

        <header>
            <p> Evenements </p>
        </header>
        <section id="event-container" >
            <div id="in-progress-event-container" class="container">
                <p> En cour </p>
                <div class="result">
                    <?php $inProgress = Event::inProgress();
                    if (empty($inProgress)) : ?>
                        <p> Aucun evenement en cour </p>
                    <?php else:
                        foreach ( $inProgress as  $event): ?>
                            <div class="event"> <p><?php $event['name']?></p> <p><?php $event['description']?></p> <p><?php $event['place']?></p></div>
                        <?php endforeach;
                    endif; ?>
                </div>
            </div>
            <div id="next-event-container"  class="container">
                <p> Prochainement </p>
                <div class="result">
                    <?php $soon = Event::soon();
                    if (empty($soon)) : ?>
                        <p> Aucun evenement prochainement </p>
                    <?php else:
                        foreach ( $soon as  $event): ?>
                            <div class="event"> <p><?php $event['name']?></p> <p><?php $event['description']?></p> <p><?php $event['place']?></p></div>
                        <?php endforeach;
                    endif; ?>
                </div>
            </div>
            <div id="all-event-container"  class="container">
                <p> Tous les evenement </p>
                <div class="result">
                    <?php $all = Event::all();
                    if (empty($all)) : ?>
                        <p> Aucun evenement </p>
                    <?php else:
                        foreach ( $all as $event): ?>
                            <div class="event">
                                <form class="ajax-form" ">
                                    <input name="event_id" hidden value="<?= $event['id']?>">
                                    <input name="event_name" value="<?= $event['name']?>" >
                                    <input name="event_desc" value="<?= $event['description']?>" >
                                    <input name="event_place" value="<?= $event['place']?>">
                                    <input name="event_start" type="date" value="<?= $event['start_at']?>">
                                    <input name="event_end" type="date" value="<?= $event['end_at']?>">
                                    <input type="submit">
                                </form>
                            </div>
                        <?php endforeach;
                    endif; ?>
                </div>
            </div>
            <div id="event-stats"  class="container">
                <p> Statistique</p>
            </div>
        </section>
    </main>
<script>
    let ajax = document.querySelectorAll(".event .ajax-form");
    for(let i of ajax) {
        i.addEventListener('submit', (event) => {
            event.preventDefault();

            let formData = new FormData(i);
            let params = Array.from(formData, ([key, value]) => `${key}=${value}`).reduce( (x,y) => x + "&" + y);

            console.log(params)
            fetch(`/api/editEvent?${params}`)
                .then( response => response.json())
                .then( data => {
                    if (data['success']) {
                        //todo: notify
                    }

                    fetch(`/api/getEvent?event_id=${formData.get('event_id')}`)
                        .then( response => response.json())
                        .then( data => {
                            i.querySelector("input[name=event_name]").value = data['name'];
                            i.querySelector("input[name=event_desc]").value = data['description'];
                            i.querySelector("input[name=event_place]").value = data['place'];
                            i.querySelector("input[name=event_start]").value = data['start_at'];
                            i.querySelector("input[name=event_end]").value = data['end_at'];
                        });
                });
        })
    }
</script>
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

    main > header {
        height: 5%;
        width: 100%;
        text-align: center;
    }

    section#event-container {
        position: relative;
        display: grid;
        grid-template-rows: 1fr 1fr 2fr;
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

    .event {
        width: 100%;
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