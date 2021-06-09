<header>
    <p> Utilisateurs </p>
</header>
<section id="user-container">
    <div id="all-users-container" class="container">
        <p class="title"> Tous les utilisateurs </p><br>
        <div class="header">
            <input disabled name="user_username" value="Pseudo">
            <input disabled name="user_mail" value="Mail">
            <input disabled name="user_password" value="Mot de passe">
            <input disabled name="user_firstname" value="Prénom">
            <input disabled name="user_lastname" value="Nom">
            <input disabled name="user_role_id" value="Rôle">
            <input disabled name="user_gender" value="Civilité">
            <input disabled name="user_birth_day" value="Date de naissance">
            <input disabled name="user_jobs" value="Activité">
            <input disabled name="user_street_number" value="N° de rue">
            <input disabled name="user_street" value="Rue">
            <input disabled name="user_cp" value="Code postal">
            <input disabled name="user_city" value="Ville">
            <input disabled name="user_country" value="Pays">
        </div>
        <div class="result">
    <?php 
    if (empty($allUsers)) {
        echo "<p> Aucun utilisateur inscrit </p>";
    }
    foreach ($allUsers as $user): ?>
            <div class="item">
                <form class="ajax-form">
                    <input hidden name="user_id" value="<?= $user['id'] ?>">
                    <input name="user_username" value="<?= $user['username'] ?>">
                    <input name="user_mail" value="<?= $user['mail'] ?>">
                    <input name="user_password" value="<?= $user['password'] ?>" type="password" disabled>
                    <input name="user_firstname" value="<?= $user['firstname'] ?>">
                    <input name="user_lastname" value="<?= $user['lastname'] ?>">
                    <select name="user_role_id">
                        <option value="staff" <?php if (isset($user['role_id']) && $user['role_id'] == 2) { echo 'selected'; }?>>staff</option>
                        <option value="staff" <?php if (isset($user['role_id']) && $user['role_id'] == 3) { echo 'selected'; }?>>staff2</option>
                        <option value="membre" <?php if (isset($user['role_id']) && $user['role_id'] == 1) { echo 'selected'; }?>>membre</option>
                    </select>
                    <select name="user_gender">
                        <option <?php if (isset($user['gender']) && $user['gender'] == 'Homme') { echo "selected";} ?> >Homme</option>
                        <option <?php if (isset($user['gender']) && $user['gender'] == 'Femme') { echo "selected";} ?> >Femme</option>
                    </select>
                    <input name="user_birth_day" value="<?= $user['birth_day'] ?>" type="date">
                    <input name="user_jobs" value="<?= $user['jobs'] ?>">
                    <input name="user_street_number" value="<?= $user['street_number'] ?>" type="number">
                    <input name="user_street" value="<?= $user['street'] ?>">
                    <input name="user_cp" value="<?= $user['cp'] ?>">
                    <input name="user_city" value="<?= $user['city'] ?>">
                    <input name="user_country" value="<?= $user['country'] ?>">
                    <label>
                        <img src="/img/trash-icon.svg" alt="delete">
                        <input name="delete" type="checkbox" value="delete">
                    </label>
                    <input type="submit" value="editer">
                </form>
            </div>
    <?php endforeach; ?>
            <br><p> Nombre d'utilisateurs : <?= sizeof($allUsers); ?> </p>
        </div>
    </div>

    <div id="add-user-container" class="container">
        <p class="title"> Ajouter un utilisateur </p><br>
        <div class="header">
            <input disabled name="user_username" value="Pseudo">
            <input disabled name="user_mail" value="Mail">
            <input disabled name="user_password" value="Mot de passe">
            <input disabled name="user_firstname" value="Prénom">
            <input disabled name="user_lastname" value="Nom">
            <input disabled name="user_role_id" value="Rôle">
            <input disabled name="user_gender" value="Civilité">
            <input disabled name="user_birth_day" value="Date de naissance">
            <input disabled name="user_jobs" value="Activité">
            <input disabled name="user_street_number" value="N° de rue">
            <input disabled name="user_street" value="Rue">
            <input disabled name="user_cp" value="Code postal">
            <input disabled name="user_city" value="Ville">
            <input disabled name="user_country" value="Pays">
        </div>
        <form class="ajax-form">
            <input name="user_username" required>
            <input name="user_mail" required>
            <input name="user_password" required type="password">
            <input name="user_firstname">
            <input name="user_lastname">
            <select name="user_role_id">
                <option value="staff">staff</option>
                <option value="staff2">staff2</option>
                <option value="membre">membre</option>
            </select>
            <select name="user_gender">
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
            </select>
            <input name="user_birth_day" type="date">
            <input name="user_jobs">
            <input name="user_street_number" type="number">
            <input name="user_street">
            <input name="user_cp" type="number">
            <input name="user_city">
            <input name="user_country">
            <input type="submit" value="ajouter">
        </form>
    </div>
</section>
<script src="/js/adminpanel-user.js"></script>