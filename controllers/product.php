<?php

if ($_GET["product_id"] == "1") {
    $img1 = "../img/qdqzdqdqzdqz.png";
    $img2 = "../img/qdqzdqdqzdqz.png";
} else if ($_GET["product_id"] == "2") {
    $img1 = "/img/balle-lakers.jpeg";
    $img2 = "/img/balle-lakers.jpeg";
} else if ($_GET["product_id"] == "3") {
    $img1 = "../img/panier.jpeg";
    $img2 = "../img/panier.jpeg";
}

require "../views/product.php";