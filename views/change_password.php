<?php
    include "../controllers/me_sql.php"; 
    if (isset($_POST['current_password'])) {
        $msg = change_password();
    }
?>

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

        <link rel="stylesheet" href="/css/sign-up.css">

        <script src="/js/header-app.js"></script>
        <title> Basket Passion | Change password </title>
    </head>

    <body>
        <?php require "../controllers/header.php"?>
        <main>
            <?php if(isset($msg) and $msg): ?>
                <div id="message"> <p><?= $msg ?></p> </div>
            <?php endif;?><br><br>
            <form method="post">
                <h1>Changer mot de passe</h1>

                <label for="current_password">Mot de passe actuel</label>
                <input type="password" name="current_password" id="current_password" placeholder="Entrer mot de passe actuel" required>

                <label for="password">Nouveau mot de passe</label>
                <input type="password" name="password" id="pass" placeholder="Entrer nouveau mot de passe" required>

                <label for="confpass">Confirmer nouveau mot de passe</label>
                <input type="password" name="confpass" id="confpass" placeholder="Confirmer nouveau mot de passe" required>

                <input type="submit" id="submit" value="Changer mot de passe">
            </form>
        </main>
    </body>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</html>