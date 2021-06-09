<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/css/reset.css">
        <link rel="stylesheet" href="/css/global.css">
        <link rel="stylesheet" href="/css/header.css">
        <link rel="stylesheet" href="/css/footer.css">
        <link rel="stylesheet" href="/css/Scrollbar.css">

        <link rel="stylesheet" href="/css/event.css">

        <script src="/js/header-app.js"></script>
        <title>Basket Passion | Event </title>
    </head>

    <body class="scrollable">
        <?php include '../controllers/header.php' ?>
        <main>
            <div id="event">
                <header id="event-header" class="container">
                    <h1 class="title"> <?= $event['name'] ?> </h1>

                    <form class="ajax-form <?= $unregistered ? 'register' : 'unregister'?>">
                        <input hidden name="event_id" value="<?= $event['id'] ?>">
                        <input <?= ($full && $unregistered ? "disabled" : "") ?> type="submit" value="<?= $unregistered ? ($full ? "Full" : "S'inscrire") : "Se desinscrire"  ?>">
                    </form>
                </header>

                <section id="event-body" class="container">
                    <p> <?= $event['description'] ?> </p>
                </section>
                <section id="event-data" class="container">
                    <?php if($oneDayEvent): ?>
                        <h2> Date: <span class="date" id="start"> <?= $event['start_at'] ?></span></h2>
                    <?php else: ?>
                        <h2> Date début: <span class="date" id="start"> <?= $event['start_at'] ?></span></h2>
                        <h2> Date fin: <span class="date" id="end"><?= $event['end_at']?></span> </h2>
                    <?php endif; ?>
                    <br>
                    <h2> Lieu: <span id="place"> <?= $event['place'] ?> </span></h2>
                    <h2> Nombre de place:
                    <?php if(is_numeric($seats)): ?>
                        <span id="free-seats"><?= $seats - $registrationNumber  ?> </span> / <span id="max-seats"><?= $seats  ?> </span></h2>
                    <?php else: ?>
                        <span id="free-seats"> <?= $seats?> </span>
                    <?php endif; ?>
                    <h2> Prix: <span id="price"><?= $event['price'] ?> </span></h2>
                </section>
            </div>
        </main>
    </body>
    <script defer src="/js/event_app.js"></script>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</html>