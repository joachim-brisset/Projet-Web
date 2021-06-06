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
    <title>Basket Passion | Event</title>
</head>

<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=assos;charset=utf8', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$reponse = $bdd->query('SELECT * FROM events');


?>



<body class="scrollable">
<?php include '../controllers/header.php' ?>


<section id="main">
    <h1>EVENEMENTS</h1>

    <div class="annonces">

<?php
    while($donnees = $reponse->fetch())
{ ?>
        <div class="scrollable annonce">
            <h2><?php echo $donnees["name"] ?></h2>
            <p><?php echo $donnees["description"]?> <br> date :<?php echo $donnees["start_at"] ?><?php if (!empty($donnees["end_at"])){echo " au " ,$donnees["end_at"];} ?> <br> lieu : <?php echo $donnees["place"] ?> <br> places : <?php if (!empty($donnees["place_number"])){echo $donnees["place_number"] ;}else {echo "illimité";}  ?></p>

        </div>

        
<?php } ?>
    </div>

</section>

</body>
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</html>