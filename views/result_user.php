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
        <link rel="stylesheet" href="/css/footer.css">
        <link rel="stylesheet" href="/css/Scrollbar.css">

        <link rel="stylesheet" href="/css/result_user.css">

        <script src="/js/header-app.js"></script>
        <title>Basket Passion | Résultats</title>
    </head>

    <body>

        <?php include '../controllers/header.php' ?>

        <main>
            <h1>PROFIL PUBLIQUE DE <?php echo $item["username"]?></h1>
            <section>
                <div>
                    <h2>pseudonyme :<?php echo $item["username"]?></h2>
                    <h2>sexe :<?php echo $item["gender"]?></h2>
                    <h2>date de naissance : <?php echo $item["birth_day"]?></h2>
                </div>

                <div>
                    <h2>profession : <?php echo $item["jobs"]?></h2>
                    <h2>rôle : <?php echo $role?></h2>
                </div>
            </section>
        </main>
    </body>
</html>