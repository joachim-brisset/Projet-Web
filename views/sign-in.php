<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="/css/reset.css">
        <link rel="stylesheet" href="/css/global.css">
        <link rel="stylesheet" href="/css/header.css">

        <link rel="stylesheet" href="/css/sign-in.css">

        <script src="/js/header-app.js"></script>
        <title> Basket Passion | Sign in </title>
    </head>
    
    <body>
    <?php require "../controllers/header.php"?>
        <main>
            <?php if(isset($msg) and $msg): ?>
                <div id="message"> <p><?= $msg ?></p> </div>
            <?php endif;?>
            <form method="post">
                <h1>connexion</h1>
        
                <label for="pseudo">mail</label>
                <input type="text" name="pseudo" id="pseudo" placeholder="Entrer mail" <?php if (isset($_POST['pseudo'])) echo 'value="'. $_POST['pseudo'] .'"'; ?>>
        
                <label for="pass">mot de passe</label>
                <input type="password" name="pass" id="pass" placeholder="Entrer mot de passe">
        
                <input type="submit" id="submit" value="login">
        
                <p>Si vous n'avez pas de compte , vous pouvez vous inscrire <a href="sign-up">ici</a>.</p>
            </form>
        </main>
    </body>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</html>