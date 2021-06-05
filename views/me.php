<?php
include "../controllers/me_sql.php";
?>

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
        <script src="/js/header-app.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">
        <title> Basket Passion | My account </title>
    </head>

    <body>
    <?php require "../controllers/header.php" ?>
    <?php
        $mail = get_mail();
        $user = get_infos();
        $role = get_role();
    ?>
        <main>
            <div id="presentation">
                <div id="data">
                    <h2 class="section_title">MON COMPTE</h2><br>
                    
                        <?php echo "Pseudo : ".$user[0]['username']." "; ?><br>
                        <?php echo "Adresse e-mail : ".$mail." "; ?><br>
                        <?php echo "Civilité : ".$user[0]['gender']; ?><br>
                        <?php echo "Date de naissance : ".$user[0]['birth_day']." "; ?><br>
                        <?php echo "Activité : ".$user[0]['jobs']." "; ?><br>
                        <?php echo "Ville de résidence : ".$user[0]['city']." "; ?><br>
                        <?php echo "Rôle : ".$role; ?><br><br>
                        
                    <h2 class="section_title">MES DONNEES PERSONNELLES</h2><br>
                    
                        <?php echo $user[0]['firstname']." "; echo $user[0]['lastname']; ?><br>
                        <?php echo $user[0]['street_number']." "; echo $user[0]['street']; ?><br>
                        <?php echo $user[0]['cp'].", "; echo $user[0]['city']; ?><br>
                        <?php echo $user[0]['country']; ?><br><br>
                        <div id="change_password">
                            <p>Mot de passe : ******** </p>
                            <button class="change_button"><a href="change_password">Modifier mot de passe »</a></button>
                        </div><br>
                        <div id="change_email">
                            <p>E-mail : <?php echo $mail; ?></p>
                            <button class="change_button"><a href="change_email">Modifier e-mail »</a></button>
                        </div><br>
                    
                    <p id="change_data_button"><button class="change_button"><a href="complete_data">Compléter/modifier mes informations »</a></button></p>
                    
                </div>

                <div id="calendar">
                    <h2 class="section_title">CALENDRIER</h2><br>
                    <h3 id="futur_events">Evénements à venir :</h3><br>
                    <?php $event = get_event(); 
                        for ($i=0; $i<sizeof($event); $i++) {
                            echo "Evénement : ". $event[$i]['name'].", ";
                            echo $event[$i]['start_at'].", ";
                            echo $event[$i]['place'].".<br>"; 
                            echo "Description : ".$event[$i]['description']."<br><br>"; 
                        }
                    ?>
                </div>
            </div>
                
        </main>
    <?php include '../views/components/footer.html' ?>
    </body>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <link rel="stylesheet" href="css/home.css">
</html>