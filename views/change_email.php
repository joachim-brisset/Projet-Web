<?php
    include "../controllers/me_sql.php"; 
    if (isset($_POST['current_mail'])) {
        $msg = change_email();
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

        <title> Basket Passion | Change mail</title>
    </head>

    <body>
        <?php require "../controllers/header.php"?>
        <main>
            <?php if(isset($msg) and $msg): ?>
                <div id="message"> <p><?= $msg ?></p> </div>
            <?php endif;?><br><br>
            <form method="post">
                <h1>Changer e-mail</h1>

                <label for="current_mail">E-mail actuel</label>
                <input type="text" name="current_mail" id="current-mail" placeholder="Entrer e-mail actuel" required>

                <label for="new_mail">Nouveau e-mail</label>
                <input type="text" name="new_mail" id="new_mail" placeholder="Entrer nouveau e-mail" required>

                <label for="new_mail">Confirmer nouveau e-mail</label>
                <input type="text" name="conf_new_mail" id="new_mail" placeholder="Confirmer nouveau e-mail" required>

                <input type="submit" id="submit" value="Changer e-mail">
            </form>
        </main>
    </body>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</html>