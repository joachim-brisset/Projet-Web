<?php
    require_once "../models/Product.php";
?>

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
        <?php
            $allProducts = Product::all();
        ?>
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
                            $produit = $_GET['product_id'];
                            if($produit=='1'){
                                echo '<h1>'.$allProducts[0]['name'].'</h1><br>
                                <p class="price">'.$allProducts[0]['price'].'€</p>';
                                $CodeProduit=1;
                                $NbProduit=1;
                                $prixProduit=$allProducts[0]['price'];
                            }
                            if($produit=='2'){
                                echo '<h1>'.$allProducts[1]['name'].'</h1><br>
                                <p class="price">'.$allProducts[1]['price'].'€</p>';
                                $CodeProduit=2;
                                $NbProduit=1;
                                $prixProduit=$allProducts[1]['price'];
                            }
                            if($produit=='3'){
                                echo '<h1>'.$allProducts[2]['name'].'</h1><br>
                                <p class="price">'.$allProducts[2]['price'].'€</p>';
                                $CodeProduit=3;
                                $NbProduit=1;
                                $prixProduit=$allProducts[2]['price'];
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
                            $produit = $_GET['product_id'];
                            if($produit=='1'){
                                echo '<u>Descrption du produit :</u><br>'.$allProducts[0]['description'];
                            }
                            if($produit=='2'){
                                echo '<u>Descrption du produit :</u><br>'.$allProducts[1]['description'];
                            }
                            if($produit=='3'){
                                echo '<u>Descrption du produit :</u><br>'.$allProducts[2]['description'];
                            }

                        ?>
                    </p>
                </div>
            </section>
        </body>
        <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
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