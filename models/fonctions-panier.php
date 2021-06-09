<?php

/**
 * Verifie si le panier existe, le crée sinon
 */
function creationPanier(){
   if (!isset($_SESSION['panier'])){
      $_SESSION['panier']=array();
      $_SESSION['panier']['CodeProduit'] = array();
      $_SESSION['panier']['NbProduit'] = array();
      $_SESSION['panier']['prixProduit'] = array();
      $_SESSION['panier']['verrou'] = false;
   }
   return true;
}


/**
 * Ajoute un article dans le panier
 */
function ajouterArticle($CodeProduit, $NbProduit){

   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Si le produit existe déjà on ajoute seulement la quantité
      $positionProduit = array_search($CodeProduit,  $_SESSION['panier']['CodeProduit']);

      if ($positionProduit !== false)
      {
         $_SESSION['panier']['NbProduit'][$positionProduit] += $NbProduit ;
      }
      else
      {
         //Sinon on ajoute le produit
         array_push( $_SESSION['panier']['CodeProduit'],$CodeProduit);
         array_push( $_SESSION['panier']['NbProduit'], $NbProduit);
         array_push( $_SESSION['panier']['prixProduit'],Product::withID($CodeProduit)["price"]);
         return true;
      }
      return false;
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
   return false;
}



/**
 * Modifie la quantité d'un article
 */
function modifierQTeArticle($CodeProduit,$NbProduit){
   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      //Si la quantité est positive on modifie sinon on supprime l'article
      if ($NbProduit > 0)
      {
         $positionProduit = array_search($CodeProduit,  $_SESSION['panier']['CodeProduit']);

         if ($positionProduit !== false)
         {
            $_SESSION['panier']['NbProduit'][$positionProduit] = $NbProduit ;
         }
      }
      else
      supprimerArticle($CodeProduit);
      return true;
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
   return false;
}

/**
 * Supprime un article du panier
 */
function supprimerArticle($CodeProduit){
   //Si le panier existe
   if (creationPanier() && !isVerrouille())
   {
      // panier temporaire
      $tmp=array();
      $tmp['CodeProduit'] = array();
      $tmp['NbProduit'] = array();
      $tmp['prixProduit'] = array();
      $tmp['verrou'] = $_SESSION['panier']['verrou'];

      for($i = 0; $i < count($_SESSION['panier']['CodeProduit']); $i++)
      {
         if ($_SESSION['panier']['CodeProduit'][$i] !== $CodeProduit)
         {
            array_push( $tmp['CodeProduit'],$_SESSION['panier']['CodeProduit'][$i]);
            array_push( $tmp['NbProduit'],$_SESSION['panier']['NbProduit'][$i]);
            array_push( $tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
         }

      }
      // panier temporaire à jour
      $_SESSION['panier'] =  $tmp;
      // efface panier temporaire
      unset($tmp);
   }
   else
   echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}


/**
 * Montant total du panier
 */
function MontantGlobal(){
   $total=0;
   for($i = 0; $i < count($_SESSION['panier']['CodeProduit']); $i++)
   {
      $total += $_SESSION['panier']['NbProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
   }
   return $total;
}


/**
 * Fonction de suppression du panier
 * @return void
 */
function supprimePanier(){
   unset($_SESSION['panier']);
}

/**
 * Permet de savoir si le panier est verrouillé
 */
function isVerrouille(){
   if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
   return true;
   else
   return false;
}

/**
 * Compte le nombre d'articles différents dans le panier
 */
function compterArticles()
{
   if (isset($_SESSION['panier']))
   return count($_SESSION['panier']['CodeProduit']);
   else
   return 0;

}

?>