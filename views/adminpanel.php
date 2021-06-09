<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="/css/adminpanel.css">
    
        <script src="/js/header-app.js"></script>
        <title> Basket Passion | AdminPanel </title>
    </head>
    
    <body>
        <nav>
            <h1><a href="/adminpanel"> Admin Panel </a></h1>
            <ul>
                <li class="nav-link"><a href="/adminpanel/users"> <p>Utilisateurs </p> <img src="/img/arrow.svg"> </a></li>
                <li class="nav-link"><a href="/adminpanel/events"> <p>Evenements</p> <img src="/img/arrow.svg"> </a></li>
                <li class="nav-link"><a href="/adminpanel/products"> <p>Produits</p> <img src="/img/arrow.svg"> </a></li>
                <li class="nav-link"><a href="/adminpanel/news"> <p>Articles</p> <img src="/img/arrow.svg"> </a></li>
                <li class="nav-link"><a href="/adminpanel/budget"> <p>Gestion du budget</p> <img src="/img/arrow.svg"> </a></li>
            </ul>
        </nav>
        
        <main>
            <?= eval("?>$mainContent")?>
        </main>
    </body>
</html>