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

    <link rel="stylesheet" href="/css/article.css">

    <script src="/js/header-app.js"></script>
    <title>Basket Passion | Actualités</title>
</head>




<body class="scrollable">
    <?php include '../controllers/header.php' ?>
    <main>
    <div class="article">
        <img class="image_article" src=<?php echo $item["picture_url"] ?> alt="picture"/>
            <div class="info">
            <h1><?php echo $item["title"] ?></h1>
            <h2 class="date">posté le <?php echo $item["created_at"] ?></h2>
            </div>
        
    </div>
    
    <p class="corps"><?php echo $item["corps"] ?></p>
    </main>
</body>


</html>