<header>
    <p> Evenements </p>
</header>
<section id="event-container" >
    <div id="in-progress-event-container" class="container">
        <p> En cour </p>
        <div class="result">

            <?php if (empty($eventInProgress)) : ?>
                <p> Aucun evenement en cour </p>
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
        <p> Prochainement </p>
        <div class="result">
            <?php if (empty($eventUpComing)) : ?>
                <p> Aucun evenement prochainement </p>
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
        <p> Tous les evenement </p>
        <div>
            <input name="event_name" disabled value="Titre">
            <input name="event_desc" disabled value="Description">
            <input name="event_place" disabled value="Lieux">
            <input name="event_start" disabled value="Debut">
            <input name="event_end" disabled value="Fin">
            <input name="event_price" disabled value="Prix">
            <input name="event_place_number" disabled value="Places">
        </div>
        <hr>
        <div class="result">
            <?php if (empty($eventAll)) : ?>
                <p> Aucun evenement </p>
            <?php else: ?>
                <?php foreach ($eventAll as $event): ?>
                    <div class="event">
                        <form class="ajax-form">
                                <input name="event_id" hidden value="<?= $event['id']?>">
                                <input name="event_name" value="<?= $event['name'] ?>">
                                <input name="event_desc" value="<?= $event['description'] ?>">
                                <input name="event_place" value="<?= $event['place'] ?>">
                                <input name="event_start" type="date" value="<?= $event['start_at']?>">
                                <input name="event_end" type="date" value="<?= $event['end_at']?>">
                                <input name="event_price" type="number" value="<?= $event['price'] ?>">
                                <input name="event_place_number" type="number" value="<?= $event['place_number'] ?>">
                                <input type="submit">
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div id="add-event-container" class="container">
        <p> Ajouter un evenement </p>
        <div>
            <input name="event_name" disabled value="Titre">
            <input name="event_desc" disabled value="Description">
            <input name="event_place" disabled value="Lieux">
            <input name="event_start" disabled value="Debut">
            <input name="event_end" disabled value="Fin">
            <input name="event_price" disabled value="Prix">
            <input name="event_place_number" disabled value="Places">
        </div>
        <form class="ajax-form">
            <input name="event_name">
            <input name="event_desc">
            <input name="event_place">
            <input name="event_start" type="date">
            <input name="event_end" type="date">
            <input name="event_price" type="number">
            <input name="event_place_number" type="number">
            <input type="submit">
        </form>
    </div>

    <div id="event-stats"  class="container">
        <p> Statistique </p>
        <div class="result">
            <p> Nombre d'évenement : <?= sizeof($eventAll) ?> </p>

        </div>
    </div>
</section>