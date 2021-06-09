<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="/css/reset.css">
        <link rel="stylesheet" href="/css/global.css">
        <link rel="stylesheet" href="/css/header.css">
        <link rel="stylesheet" href="/css/footer.css">

        <link rel="stylesheet" href="/css/search.css">

        <script src="/js/header-app.js"></script>
        <title> Basket Passion | Search </title>
    </head>

    <body>
        <?php require "../controllers/header.php" ?>
        <main>
            <h1> Votre recherche : <span><?= $query ?? "" ?></span></h1>
            <div class="separator"> </div>

            <div class="result-container">
                <?php if($searchUser or $forceSearch): ?>
                <div id="user-results">
                    <h2> Users </h2>
                    <div class="card-container">
                        <?php foreach ($userResult as $item): ?>
                        <a class="card" href="/users/<?= $item['username'] ?>">
                            <img src="/img/user-icon2.svg">
                            <p> <?= $item['username'] ?> </p>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($searchEvent or $forceSearch): ?>
                <div id="event-results">
                    <h2> Evenement </h2>
                    <div class="card-container">
                        <?php foreach ($eventResult as $item): ?>
                            <a class="card" href="/event/<?= $item['id'] ?>">
                                <img src="/img/event-icon.svg">
                                <p> <?= $item['name'] ?> </p>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($searchProduct or $forceSearch): ?>
                <div id="product-results">
                    <h2> Produits </h2>
                    <div class="card-container">
                        <?php foreach ($productResult as $item): ?>
                            <a class="card" href="/product/<?= $item['id'] ?>">
                                <img src="/img/cart.svg">
                                <p> <?= $item['name'] ?> </p>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </main>
        <?php require "../views/components/footer.html" ?>
    </body>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</html>