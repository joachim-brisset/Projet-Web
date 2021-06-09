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
        <link rel="stylesheet" href="/css/Scrollbar.css">

        <link rel="stylesheet" href="/css/store.css">
        <script src="/js/header-app.js"></script>
        <title>Document</title>
    </head>
    <body class="scrollable">
        <?php include '../controllers/header.php' ?>

        <main>
            <a href="/cart">
                <ion-icon name="cart-outline" class="iconCart" href="cart.php"></ion-icon>
            </a>
            <h2 class="section-title">Store</h2>
            <div class="list-product">
                <div class="first-row">
                    <a class="product tshirt-orchide"  onclick="document.getElementById('premierproduit').submit()">
                        <form method="post" action="/product?product=Supraw" id="premierproduit" class="inline">
                            <input type="hidden" name="produit" value="Tshirt-orchide">
                        </form>
                    </a>

                    <div class="title-mid">
                        <p>nouvelle balle dispo réalisée par SUPRAW</p>
                        <a  href="/product?product=Supraw" onclick="document.getElementById('premierproduit').submit()">acheter</a>
                    </div>
                </div>

                <div class="second-row">
                    <a class="product hoodie" href="#" onclick="document.getElementById('troisièmeproduit').submit()">
                        <form method="post" action="/product?product=Lakers" id="troisièmeproduit" class="inline">
                            <input type="hidden" name="produit" value="Hoodie genese" >
                        </form>
                        <div class="product-details">
                            <p class="product-name">Balle spalding NBA</p>
                            <p class="product-price">50,00€</p>
                        </div>
                    </a>

                    <a class="product secret" href="#" onclick="document.getElementById('produitsecret').submit()">
                        <form method="post" action="/product?product=Panier" id="produitsecret" class="inline">
                            <input type="hidden" name="produit" value="Hoodie genese" >
                        </form>
                        <div class="product-details">
                            <p class="product-name">Panier Chinatown Market</p>
                            <p class="product-price">70,00€</p>
                        </div>
                    </a>
                </div>

            </div>
        </main>
    </body>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</html>