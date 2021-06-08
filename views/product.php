<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/header.css">

    <link rel="stylesheet" href="/css/styleProduit.css">
    <link href="/css/jqloupe.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/jqloupe.js"></script>
    <script src="/js/header-app.js"></script>

    <title>Basket Passion | Products</title>
</head>

<main>  
    <a href="/cart">
        <ion-icon name="cart-outline" class="iconCart" href="cart.php"></ion-icon>
    </a>
    <body class="fond">
    <?php include '../controllers/header.php' ?>
    <section id="produit">
        <div id="teeshirt">
            
            <div class="smallcase">
                <img src= <?php echo $img1; ?> id="img1" class="smallimg" onclick="ChangeImg(1)">
            </div>
            <div class="smallcase">
                <img src= <?php echo $img2; ?> id="img2" class="smallimg" onclick="ChangeImg(2)">
            </div>

            <a class="zoom" style="position: absolute;">
                <img src=<?php echo $img1 ?> class="phototee" id="tee">
            </a>
            <div class="ronds">
                <span id="rond1" class="rond" style="left:48%; background-color: rgb(192, 184, 184);" name="rond1"></span>
                <span id="rond2" class="rond" style="left:49%; background-color: rgb(109, 109, 109);" name="rond2"></span>

            </div>
        </div>
        <div class="infos">
            <?php 
                    $produit = $_GET['product'];
                    if($produit=='Supraw'){
                        echo '<h1> Ballon de basket "Supraw"</h1><br>
                        <p class="price">400,00€</p>';
                        $CodeProduit=1;
                        $NbProduit=1;
                        $prixProduit=400;
                    }
                    if($produit=='Lakers'){
                        echo '<h1> Ballon de basket "Lakers"</h1><br>
                        <p class="price">50,00€</p>';
                        $CodeProduit=2;
                        $NbProduit=1;
                        $prixProduit=50;
                    }
                    if($produit=='Panier'){
                        echo '<h1> Panier Chinatown market</h1><br>
                        <p class="price">70,00€</p>';
                        $CodeProduit=3;
                        $NbProduit=1;
                        $prixProduit=70;
                    }

                ?>
            
            <p>Taxes incluses. Frais d'expédition calculés lors du passage à la caisse.</p>
                

            <form id="productForm">
                <label>Quantité
                    <input type="number" name="qqte" value=1>
                </label>
                <input hidden name="ProductId" value=<?php echo $CodeProduit ?>>
                <input type="submit" class="boutonPan" id='ajouter'><b>Ajouter au panier</b></input>
            </form>
            

        </div>
        <div class="desciption">
        
            <p>
            <?php 
                    $produit = $_GET['product'];
                    if($produit=='Supraw'){
                        echo '<u>Descrption du produit :</u>
                        <li>Desing unique et coloré, produit en quantité limité</li>
                        <li>Nombres de couches : 3</li>
                        <li>Vessie : Butyle parfaite tenue au gonflage</li>
                        <li>Carcasse : Nylon renforcé, montage pro dynamique</li>';
                    }
                    if($produit=='Lakers'){
                        echo '<u>Descrption du produit :</u>
                        <li>Cuir naturel haut de gamme</li>
                        <li>Nombres de couches : 5</li>
                        <li>Vessie : Butyle parfaite tenue au gonflage</li>
                        <li>Carcasse : Nylon renforcé, montage pro dynamique</li>';
                    }
                    if($produit=='Panier'){
                        echo '<u>Descrption du produit :</u>
                        <li>Résiste aux intempéries</li>
                        <li>Desing unique, produit en quantité limité</li>
                        <li>Attache filet : Tube ou Queue de cochon </li>
                        <li>Arceau : Spécial Dunk</li>';
                    }

                ?>
            </p>        
            
            
        </div>
    </section>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    </body>
</main>

</html>

<script>
    var taille = "";

    $(function() {
        $('a.zoom').jQLoupe();
    });

    function ChangeImg(num) {
        if (num == 2) {
            $("#tee").fadeToggle(200, "linear");
            setTimeout(ChangerTee1, 200);
            $("#tee").fadeToggle(200, "linear");
        }
        if (num == 1) {
            $("#tee").fadeToggle(200, "linear");
            setTimeout(ChangerTee2, 200);
            $("#tee").fadeToggle(200, "linear");
        }
    }

    function ChangerTee1() {
        document.getElementById('tee').src = document.getElementById('img2').src;
        document.getElementById('rond1').style.background = 'rgb(109, 109, 109)';
        document.getElementById('rond2').style.background = 'rgb(192, 184, 184)';
    }

    function ChangerTee2() {
        document.getElementById('tee').src = document.getElementById('img1').src;
        document.getElementById('rond1').style.background = 'rgb(192, 184, 184)';
        document.getElementById('rond2').style.background = 'rgb(109, 109, 109)';
    }
</script>
<script defer src="/js/ajouterPanier.js"> </script>