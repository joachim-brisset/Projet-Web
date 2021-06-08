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
    <link rel="stylesheet" href="/css/Scrollbar.css">

    <link rel="stylesheet" href="/css/home.css">


    <script src="/js/header-app.js"></script>
    <title> Basket Passion | Home </title>
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

$reponse = $bdd->query('SELECT * FROM articles ORDER BY created_at LIMIT 4 ');


?>



<body class="scrollable">
<?php include '../controllers/header.php' ?>

<main>
    <section id="cover">
        <img src="/img/background.jpeg" alt="basketball cover photo">

        <div id="cover-bottom">
            <div class="advertisement-overlay">
                <div class="circle n1"></div>
                <div class="circle n2"></div>

                <div class="content">
                    <img id="ball" src="/img/qdqzdqdqzdqz.png" />
                    <div>
                        <p>Nouvelle balle en collaboration avec <span class="uppercase">supraw</span>®</p>
                        <p class="uppercase">dispo dans la boutique</p>
                    </div>
                </div>
            </div>

            <a class="scroll-down" href="#news">
                <ion-icon name="arrow-down-circle-outline"></ion-icon>
            </a>
        </div>
    </section>

    <section id="news">
        <h1> News </h1>
        <div class="scrollable">

            <?php while ($item = $reponse->fetch()) :?>
                <div class="news">
                    <img src=<?php echo $item["picture_url"] ?> alt="picture"/>
                    <div>
                        <h3 class="title"><?php echo $item["title"] ?></h3>
                        <h4 class="date">posté le <?php echo $item["created_at"] ?></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam odio repellendus facere accusamus amet error assumenda similique voluptatibus commodi ut quaerat omnis velit aspernatur quia fugit, earum, dicta id accusantium. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam odio repellendus facere accusamus amet error assumenda similique voluptatibus commodi ut quaerat omnis velit aspernatur quia fugit, earum, dicta id accusantium.</p>
                        <a href="/article?eventid=<?=$item["id"] ?>" class="suite">Lire la suite</a>
                    </div>
                </div>
            <?php endwhile; ?>
            <a href="/news" id="loadMoreButton"> CHARGER PLUS ! </a>
        </div>
    </section>
</main>

<?php include '../views/components/footer.html' ?>
</body>
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>

</html>