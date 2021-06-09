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
    <?php include "../controllers/header.php"?>
        <main>

            <form method="post">
                <h1>Mes informations</h1>
    
                <div id="civility">
                    Mlle :<input type="radio" name="gender" value="Femme" <?php if (isset($user[0]['gender']) and $user[0]['gender']=='Femme') { echo "checked"; }?>>
                    Mr :<input type="radio" name="gender" value="Homme" <?php if (isset($user[0]['gender']) and $user[0]['gender']=='Homme') { echo "checked"; }?>>
                </div>
                
                <div id="complete_data_presentation">
                    
                    <div id="person_infos">

                        <label for="username">Pseudo :</label><span><?php if ($_SESSION['data_error']['0'] != "") { echo $_SESSION['data_error']['0']; } ?></span><br>
                        <input type="text" name="username" id="username" placeholder="Entrer votre pseudo" <?php if (isset($_POST['username'])) { echo "value='".$_POST['username']."'"; } else if (isset($user[0]['username'])) { echo "value='".$user[0]['username']."'"; }  ?>>

                        <label for="birth_day">Date de naissance :</label><span><?php if ($_SESSION['data_error']['3'] != "") { echo $_SESSION['data_error']['3']; } ?></span><br>
                        <input type="date" id="birth_day" name="birth_day" value="<?php if (isset($_POST['birth_day'])) { echo $_POST['birth_day'][0].$_POST['birth_day'][1].$_POST['birth_day'][2].$_POST['birth_day'][3]."-".$_POST['birth_day'][5].$_POST['birth_day'][6]."-".$_POST['birth_day'][8].$_POST['birth_day'][9]; } else if (isset($user[0]['birth_day'])) { echo $user[0]['birth_day'][0].$user[0]['birth_day'][1].$user[0]['birth_day'][2].$user[0]['birth_day'][3]."-".$user[0]['birth_day'][5].$user[0]['birth_day'][6]."-".$user[0]['birth_day'][8].$user[0]['birth_day'][9];}?>">

                        <label for="jobs">Activité :</label><span><?php if ($_SESSION['data_error']['4'] != "") { echo $_SESSION['data_error']['4']; } ?></span><br>
                        <input type="text" name="jobs" id="jobs" placeholder="Entrer votre activité (ex. : étudiant)" <?php if (isset($_POST['jobs'])) { echo "value='".$_POST['jobs']."'"; } else if (isset($user[0]['jobs'])) { echo "value='".$user[0]['jobs']."'"; }?>>

                        <label for="firstname">Prénom :</label><span><?php if ($_SESSION['data_error']['1'] != "") { echo $_SESSION['data_error']['1']; } ?></span><br>
                        <input type="text" name="firstname" id="firstname" placeholder="Entrer votre prénom" <?php if (isset($_POST['firstname'])) { echo "value='".$_POST['firstname']."'"; } else if (isset($user[0]['firstname'])) { echo "value='".$user[0]['firstname']."'"; }?>>

                        <label for="lastname">Nom :</label><span><?php if ($_SESSION['data_error']['2'] != "") { echo $_SESSION['data_error']['2']; } ?></span><br>
                        <input type="text" name="lastname" id="lastname" placeholder="Entrer votre nom" <?php if (isset($_POST['lastname'])) { echo "value='".$_POST['lastname']."'"; } else if (isset($user[0]['lastname'])) { echo "value='".$user[0]['lastname']."'"; }?>>
                        
                    </div>
                    <div id="address">

                        <label for="street_number">Numéro de rue :</label><span><?php if ($_SESSION['data_error']['9'] != "") { echo $_SESSION['data_error']['9']; } ?></span><br>
                        <input type="text" name="street_number" id="street_number" placeholder="Entrez votre numéro de rue" <?php if (isset($_POST['street_number'])) { echo "value='".$_POST['street_number']."'"; } else if (isset($user[0]['street_number'])) { echo "value='".$user[0]['street_number']."'"; }?>>

                        <label for="street">Rue :</label><span><?php if ($_SESSION['data_error']['8'] != "") { echo $_SESSION['data_error']['8']; } ?></span><br>
                        <input type="text" name="street" id="street" placeholder="Entrez votre rue" <?php if (isset($_POST['street'])) { echo "value='".$_POST['street']."'"; } else if (isset($user[0]['street'])) { echo "value='".$user[0]['street']."'"; }?>>

                        <label for="city">Ville :</label><span><?php if ($_SESSION['data_error']['5'] != "") { echo $_SESSION['data_error']['5']; } ?></span><br>
                        <input type="text" name="city" id="city" placeholder="Entrez votre ville" <?php if (isset($_POST['city'])) { echo "value='".$_POST['city']."'"; } else if (isset($user[0]['city'])) { echo "value='".$user[0]['city']."'"; }?>>

                        <label for="cp">Code postal :</label><span><?php if ($_SESSION['data_error']['7'] != "") { echo $_SESSION['data_error']['7']; } ?></span><br>
                        <input type="text" name="cp" id="cp" placeholder="Entrez votre code postal" <?php if (isset($_POST['cp'])) { echo "value='".$_POST['cp']."'"; } else if (isset($user[0]['cp'])) { echo "value='".$user[0]['cp']."'"; }?>>

                        <label for="country">Pays :</label><span><?php if ($_SESSION['data_error']['6'] != "") { echo $_SESSION['data_error']['6']; } ?></span><br>
                        <input type="text" name="country" id="country" placeholder="Entrez votre pays" <?php if (isset($_POST['country'])) { echo "value='".$_POST['country']."'"; } else if (isset($user[0]['country'])) { echo "value='".$user[0]['country']."'"; }?>>
                        
                    </div>
                    
                </div>
                <p id="button_change_data"><input type="submit" id="submit" value="Confirmer" name="confirm"></p>
            </form>
        </main>
    </body>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</html>