<?php
require_once "../models/Product.php";
include_once "../models/fonctions-panier.php";

$erreur = false;

$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{
   if(!in_array($action,array('ajout', 'suppression', 'refresh')))
   $erreur=true;

   //récupération des variables en POST ou GET
   $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
   $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
   $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;

   $l = preg_replace('#\v#', '',$l);
   //On vérifie que $p est un float
   $p = floatval($p);

    
   if (is_array($q)){
      $NbProduit = array();
      $i=0;
      foreach ($q as $contenu){
         $NbProduit[$i++] = intval($contenu);
      }
   }
   else
   $q = intval($q);
    
}

if (!$erreur){
   switch($action){
      Case "ajout":
         ajouterArticle($l,$q);
         break;

      Case "suppression":
         supprimerArticle($l);
         break;

      Case "refresh" :
         for ($i = 0 ; $i < count($QteArticle) ; $i++)
         {
            modifierQTeArticle($_SESSION['panier']['CodeProduit'][$i],round($QteArticle[$i]));
         }
         break;

      Default:
         break;
   }
}
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

    <link rel="stylesheet" href="/css/styleCart.css">

    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="/js/header-app.js"></script>

    <title>Basket Passion | Products</title>
</head>
<body class="scrollable">
<?php include "components/header.php"?>

<div class="panier">
<?php
    if (creationPanier()):
       $nbArticles=count($_SESSION['panier']['CodeProduit']);
       if ($nbArticles <= 0): ?>
            <p>Votre panier est vide </p>
       <?php else:
            for ($i=0 ;$i < $nbArticles ; $i++): ?>
                <div class="cart-item">
                    <p><?= Product::withID($_SESSION['panier']['CodeProduit'][$i])['name'] ?></p>
                    <form class="productForm">
                        <input hidden type="number" name="productId" value="<?= htmlspecialchars($_SESSION['panier']['CodeProduit'][$i]) ?>">
                        <input type="number" name="qte" value=<?=$_SESSION['panier']['NbProduit'][$i]?>>
                        <input type="submit" value="edit">
                    </form>

                    <p><?=htmlspecialchars($_SESSION['panier']['prixProduit'][$i]) ?> € </p>
                    <a href="<?=htmlspecialchars("cart?action=suppression&l=".rawurlencode($_SESSION['panier']['CodeProduit'][$i]))?> ">Supprimer article</a>
                </div>
            <?php endfor; ?>

          <p>Total : <span id='CartAmount'> <?=MontantGlobal()?></span></p>
          <input type="submit" value="Rafraichir"/>
          <input type="hidden" name="action" value="refresh"/>
       <?php endif;
    endif;

    /*
    $CodeProduit=1;
    $NbProduit=1;
    $prixProduit=50;
    */

    ?>
    <button id="clearCart-but"> Vider le panier</button>
    
    </div>
</body>
<script defer src="/js/supprimerPanier.js"></script>
<script defer src="/js/modifierQtePanier.js"></script>