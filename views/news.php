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

    <link rel="stylesheet" href="/css/news.css">

    <script src="/js/header-app.js"></script>
    <title>Basket Passion | Actualités</title>
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

$reponse = $bdd->query('SELECT * FROM articles ORDER BY created_at  ');


?>

<body class="scrollable">
<?php include '../controllers/header.php' ?>

<main>
<section id="news">
        <h1> News </h1>
        <div >

            <?php while ($item = $reponse->fetch()) :?>
                <div class="news">
                    <img src=<?php echo $item["picture_url"] ?> alt="picture"/>
                    <div>
                        <h3 class="title"><?php echo $item["title"] ?></h3>
                        <h4 class="date">posté le <?php echo $item["created_at"] ?></h4>
                        <p class="corps"><?php echo $item["corps"] ?></p>
                    </div>
                    <a href="/article?eventid=<?=$item["id"] ?>" class="suite">Lire la suite</a>
                </div>
            <?php endwhile; ?>
            
        </div>
    </section>
</main>

</body>



</html>