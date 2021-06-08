<?php

include_once("fonctions-panier.php");

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
         ajouterArticle($l,$q,$p);
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
    if (creationPanier())
    {
       $nbArticles=count($_SESSION['panier']['CodeProduit']);
       if ($nbArticles <= 0)
       echo "<tr><td>Votre panier est vide </td></tr>";
       else
       {
          for ($i=0 ;$i < $nbArticles ; $i++)
          {
             echo "<tr>";
             echo "<td>".htmlspecialchars($_SESSION['panier']['CodeProduit'][$i])."</ td><br>";
             echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['NbProduit'][$i])."\"/></td>";
             echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td><br>";
             echo "<td><a href=\"".htmlspecialchars("cart?action=suppression&l=".rawurlencode($_SESSION['panier']['CodeProduit'][$i]))."\">Supprimer article</a></td><br>";
             echo "</tr>";
          }

          echo "<tr><td colspan=\"2\"> </td>";
          echo "<td colspan=\"2\">";
          echo "Total : ".MontantGlobal();
          echo "</td></tr>";

          echo "<tr><td colspan=\"4\">";
          echo "<input type=\"submit\" value=\"Rafraichir\"/>";
          echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

          echo "</td></tr>";
       }
    }
    $CodeProduit=1;
    $NbProduit=1;
    $prixProduit=50;



    ?>
    <input type="submit" action="supprimePanier()"></input>
    
</div>

    


</body>


</body>