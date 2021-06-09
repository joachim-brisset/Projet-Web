<header>
    <p> Evénements </p>
</header>
<section id="event-container" >
    <div id="in-progress-event-container" class="container">
        <p class="title"> En cours </p>
        <div class="result">

            <?php if (empty($eventInProgress)) : ?>
                <p> Aucun événement en cours </p>
            <?php else:
                foreach ($eventInProgress as $event): ?>
                    <div class="event">
                        <input disabled value="<?= $event['name']?>">
                        <input disabled value="<?= $event['description']?>">
                        <input disabled value="<?= $event['place']?>">
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
    <div id="next-event-container"  class="container">
        <p class="title"> Prochainement </p>
        <div class="result">
            <?php if (empty($eventUpComing)) : ?>
                <p> Aucun événement prochainement </p>
            <?php else:
                foreach ($eventUpComing as $event): ?>
                    <div class="event">
                        <input disabled value="<?= $event['name']?>">
                        <input disabled value="<?= $event['description']?>">
                        <input disabled value="<?= $event['place']?>">
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
    <div id="all-event-container"  class="container">
        <p class="title"> Tous les événements </p>
        <div class="container-header">
            <input name="event_name" disabled value="Titre">
            <input name="event_desc" disabled value="Description">
            <input name="event_place" disabled value="Lieux">
            <input name="event_start" disabled value="Debut">
            <input name="event_end" disabled value="Fin">
            <input name="event_price" disabled value="Prix">
            <input name="event_place_number" disabled value="Places">
            <input name="event_cost" disabled value="Coût">
        </div>
        <hr>
        <div class="result">
            <?php if (empty($eventAll)) : ?>
                <p> Aucun événement </p>
            <?php else: ?>
                <?php foreach ($eventAll as $event): ?>
                    <div class="event">
                        <form class="ajax-form event-info">
                                <input name="event_id" hidden value="<?= $event['id']?>">
                                <input name="event_name" value="<?= $event['name'] ?>">
                                <input name="event_desc" value="<?= $event['description'] ?>">
                                <input name="event_place" value="<?= $event['place'] ?>">
                                <input name="event_start" type="date" value="<?= $event['start_at']?>">
                                <input name="event_end" type="date" value="<?= $event['end_at']?>">
                                <input name="event_price" type="number" value="<?= $event['price'] ?>">
                                <input name="event_place_number" type="number" value="<?= $event['place_number'] ?>">
                                <input name="event_cost" type="number" value="<?= $event['event_cost'] ?>">
                                <label>
                                    <img src="/img/trash-icon.svg" alt="delete">
                                    <input name="delete" type="checkbox" value="delete">
                                </label>
                                <input type="submit" value="editer">
                        </form>
                        <button class="expand-button"> + </button>
                        <div class="user-container">
                            <?php $registrations = Registration::with(['event_id' => $event['id']]) ?>
                            <p> nombre d'inscriptions : <?= sizeof($registrations)?></p>
                            <input disabled value="USERNAME">
                            <input disabled value="MAIL">
                            <input disabled value="GENDER">
                            <input disabled value="REGISTRATION DATE">
                            <?php foreach ($registrations as $registration):
                                $user = User::withID($registration['user_id']) ?>
                            <form class="ajax-form user-info">
                                <input name="event_id" hidden value="<?= $event['id']?>">
                                <input name="user_id" hidden value="<?= $user['id']?>">
                                <input disabled value="<?= $user['username']?>">
                                <input disabled value="<?= $user['mail']?>">
                                <input disabled value="<?= $user['gender']?>">
                                <input disabled value="<?= $registration['registered_at']?>">
                                <input type="submit" value="-">
                            </form>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div id="add-event-container" class="container">
        <p class="title"> Ajouter un événement </p>
        <div class="header">
            <input name="event_name" disabled value="Titre">
            <input name="event_desc" disabled value="Description">
            <input name="event_place" disabled value="Lieux">
            <input name="event_start" disabled value="Debut">
            <input name="event_end" disabled value="Fin">
            <input name="event_price" disabled value="Prix">
            <input name="event_place_number" disabled value="Places">
            <input name="event_cost" disabled value="Coût">
        </div>
        <form class="ajax-form event-info">
            <input autocomplete="off" name="event_name">
            <input autocomplete="off" name="event_desc">
            <input autocomplete="off" name="event_place">
            <input autocomplete="off" name="event_start" type="date">
            <input autocomplete="off" name="event_end" type="date">
            <input autocomplete="off" name="event_price" type="number">
            <input autocomplete="off" name="event_place_number" type="number">
            <input autocomplete="off" name="event_cost" type="number">
            <input type="submit">
        </form>
    </div>

    <div id="event-stats"  class="container">
        <p class="title"> Statistique </p>
        <div class="result">
            <p> Nombre d'événements : <?= sizeof($eventAll) ?> </p>
            <p> Nombre d'inscriptions : <?= sizeof(Registration::with([])) ?> </p>
        </div>
    </div>
</section>
<script defer src="/js/adminpanel-event.js"> </script>