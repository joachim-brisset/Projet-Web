<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/css/reset.css">
        <link rel="stylesheet" href="/css/global.css">
        <link rel="stylesheet" href="/css/header.css">
        <link rel="stylesheet" href="/css/footer.css">
        <link rel="stylesheet" href="/css/Scrollbar.css">
        <link rel="stylesheet" href="/css/me.css">
        <link rel="stylesheet" href="/css/complete_data.css">
        <script src="/js/header-app.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">
        <title> Basket Passion | Compelete my data </title>
    </head>
    <body>
    <?php require "../controllers/header.php"?>
        <main>
            <?php
                include "../controllers/me_sql.php";
                if (isset($_POST['confirm'])) {
                    $name_bdd = ['username', 'firstname', 'lastname', 'gender', 'birth_day', 'jobs', 'city', 'country', 'cp', 'street', 'street_number'];
                    $name_form = ['username', 'firstname', 'lastname', 'gender', 'birth_day', 'jobs', 'city', 'country', 'cp', 'street', 'street_number'];
        
                    $data = get_infos();

                    for ($i=0; $i<sizeof($name_bdd); $i++) {
                        if (!isset($data[0][$name_bdd[$i]])) {
                            if (isset($_POST[$name_form[$i]])) {
                                echo "<p id='paragraphe'>Bonjour</p>";
                                $msg = $name_form[$i]." : marché";
                            }
                        }
                    }
                    //$msg = complete_data();
                }
            ?>
            <?php if(isset($msg) and $msg): ?>
                <div id="message"> <p><?= $msg ?></p> </div>
            <?php endif;?>
            <?php
                $mail = get_mail();
                $user = get_infos();
            ?>
            <form method="post">
                <h1>Mes informations</h1>
    
                <div id="civility">
                    Mlle :<input type="radio" name="gender" value="Femme" <?php if (isset($user[0]['gender']) and $user[0]['gender']=='Femme') { echo "checked"; }?>>
                    Mr :<input type="radio" name="gender" value="Homme" <?php if (isset($user[0]['gender']) and $user[0]['gender']=='Homme') { echo "checked"; }?>>
                </div>
                
                <div id="complete_data_presentation">
                    
                    <div id="person_infos">

                        <label for="username">Pseudo :</label><br>
                        <input type="text" name="username" id="username" placeholder="Entrer votre pseudo" <?php if (isset($user[0]['username'])) { echo "value='".$user[0]['username']."'"; }?>>

                        <label for="birth_day">Date de naissance :</label><br>
                        <input type="date" id="birth_day" name="birth_day" value="<?php if (isset($user[0]['birth_day'])) { echo $user[0]['birth_day'][0].$user[0]['birth_day'][1].$user[0]['birth_day'][2].$user[0]['birth_day'][3]."-".$user[0]['birth_day'][5].$user[0]['birth_day'][6]."-".$user[0]['birth_day'][8].$user[0]['birth_day'][9];}?>">

                        <label for="jobs">Activité :</label><br>
                        <input type="text" name="jobs" id="jobs" placeholder="Entrer votre activité (ex. : étudiant)" <?php if (isset($user[0]['jobs'])) { echo "value='".$user[0]['jobs']."'"; }?>>

                        <label for="firstname">Prénom :</label><br>
                        <input type="text" name="firstname" id="firstname" placeholder="Entrer votre prénom" <?php if (isset($user[0]['firstname'])) { echo "value='".$user[0]['firstname']."'"; }?>>

                        <label for="lastname">Nom :</label><br>
                        <input type="text" name="lastname" id="lastname" placeholder="Entrer votre nom" <?php if (isset($user[0]['lastname'])) { echo "value='".$user[0]['lastname']."'"; }?>>
                        
                    </div>
                    <div id="address">

                        <label for="street_number">Numéro de rue :</label><br>
                        <input type="text" name="street_number" id="street_number" placeholder="Entrez votre numéro de rue" <?php if (isset($user[0]['street_number'])) { echo "value='".$user[0]['street_number']."'"; }?>>

                        <label for="street">Rue :</label><br>
                        <input type="text" name="street" id="street" placeholder="Entrez votre rue" <?php if (isset($user[0]['street'])) { echo "value='".$user[0]['street']."'"; }?>>

                        <label for="city">Ville :</label><br>
                        <input type="text" name="city" id="city" placeholder="Entrez votre ville" <?php if (isset($user[0]['city'])) { echo "value='".$user[0]['city']."'"; }?>>

                        <label for="cp">Code postal :</label><br>
                        <input type="text" name="cp" id="cp" placeholder="Entrez votre code postal" <?php if (isset($user[0]['cp'])) { echo "value='".$user[0]['cp']."'"; }?>>

                        <label for="country">Pays :</label><br>
                        <input type="text" name="country" id="country" placeholder="Entrez votre pays" <?php if (isset($user[0]['country'])) { echo "value='".$user[0]['country']."'"; }?>>
                        
                    </div>
                    
                </div>
                <p id="button_change_data"><input type="submit" id="submit" value="Confirmer" name="confirm"></p>
            </form>
        </main>
    </body>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</html>