<?php

    require_once "../models/Session.php";
    require_once "../models/Authentication.php";

    if (Authentication::isAuth()['auth']) {
        Session::extendValidity();
    } else header("Location: /sign-in");

    function get_mail() {
    
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $req = $db -> prepare("SELECT mail FROM users WHERE id = :user_id");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req -> bindValue( ":user_id", $_SESSION[Session::ID], PDO::PARAM_STR);

        $req -> execute();
        $result = $req -> fetchAll();
        return $result[0]['mail'];
    }

    function get_infos() {
    
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $req = $db -> prepare("SELECT * FROM users WHERE id = :user_id");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req -> bindValue( ":user_id", $_SESSION[Session::ID], PDO::PARAM_STR);

        $req -> execute();
        $result = $req -> fetchAll();
        return $result;
        
    }

    function get_role() {
    
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $req = $db -> prepare("SELECT roles.role FROM roles, users WHERE roles.id = users.role AND users.id = :user_id");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req -> bindValue( ":user_id", $_SESSION[Session::ID], PDO::PARAM_STR);

        $req -> execute();
        $result = $req -> fetchAll();
        return $result[0]['role'] ?? null;
        
    }

    function get_event() {
    
        $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

        $req = $db -> prepare("SELECT * FROM users u, registration r, events e WHERE u.id = r.user_id AND u.id = :user_id AND r.event_id = e.id");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req -> bindValue( ":user_id", $_SESSION[Session::ID], PDO::PARAM_STR);

        $req -> execute();
        $result = $req -> fetchAll();
        return $result;
    
    }

    function change_email() {
    
        if ($_POST['new_mail'] == $_POST['conf_new_mail']) {
            $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

            $req = $db -> prepare("SELECT mail FROM users WHERE id = :user_id");
            $req->setFetchMode(PDO::FETCH_ASSOC);
            $req -> bindValue( ":user_id", $_SESSION[Session::ID], PDO::PARAM_STR);
            $req -> execute();
            $result = $req -> fetchAll();

            if ($_POST['current_mail'] == $result[0]['mail']) {
                if ($_POST['current_mail'] != $_POST['new_mail']) {

                    $req = $db -> prepare("UPDATE users u
                                            SET u.mail = REPLACE(mail, :current_mail, :new_mail)
                                            WHERE u.id = :user_id");
                    $req->setFetchMode(PDO::FETCH_ASSOC);
                    $req -> bindValue( ":user_id", $_SESSION[Session::ID], PDO::PARAM_STR);
                    $req -> bindValue( ":current_mail", $_POST['current_mail'], PDO::PARAM_STR);
                    $req -> bindValue( ":new_mail", $_POST['new_mail'], PDO::PARAM_STR);
                    $req -> execute();
                    header("Location: /");
                } else {
                    $msg = "Votre nouveau mail doit être différent de votre mail actuel";
                }
            } else {
                $msg = "Mail actuel invalide";
            }
        } else {
            $msg = "Vous avez entré deux mails différents, veuillez vérifier votre saisie";
        }
        return $msg;
    }

    function change_password() {
        
        if ($_POST['password'] == $_POST['confpass']) {
    
            $db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

            $req = $db -> prepare("SELECT password FROM users WHERE id = :user_id");
            $req->setFetchMode(PDO::FETCH_ASSOC);
            $req -> bindValue( ":user_id", $_SESSION[Session::ID], PDO::PARAM_STR);
            $req -> execute();
            $result = $req -> fetchAll();

            if (password_verify($_POST["current_password"], $result[0]['password'])) {
                if ($_POST['current_password'] != $_POST['password']) {

                    $req = $db -> prepare("UPDATE users u
                                            SET u.password = REPLACE(password, :current_password, :new_password)
                                            WHERE u.id = :user_id");
                    $req->setFetchMode(PDO::FETCH_ASSOC);
                    $req -> bindValue( ":user_id", $_SESSION[Session::ID], PDO::PARAM_STR);
                    $req -> bindValue( ":current_password", $result[0]['password'], PDO::PARAM_STR);
                    $req -> bindValue( ":new_password", password_hash($_POST['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
                    $req -> execute();
                    header("Location: /");
                } else {
                    $msg = "Votre nouveau mot de passe doit être différent de votre mot de passe actuel";
                }

            } else {
                $msg = "Mot de passe actuel invalide";
            }
        } else {
            $msg = "Vous avez entré deux mots de passe différents, veuillez vérifier votre saisie";
        }
        return $msg;
    }

    function complete_data() {
        
        $msg = NULL;
        
        $name_bdd = ['username', 'firstname', 'lastname', 'gender', 'birth_day', 'jobs', 'city', 'country', 'cp', 'street', 'street_number'];
        $name_form = ['username', 'firstname', 'lastname', 'gender', 'birth_day', 'jobs', 'city', 'country', 'cp', 'street', 'street_number'];
        
        $data = get_infos();
        
        for ($i=0; $i<sizeof($name_bdd); $i++) {
            if (!isset($data[0][$name_bdd[$i]])) {
                if (isset($_POST[$name_form[$i]])) {
                    $msg = $name_form[$i]." : marché";
                }
            }
        }
        
        return $msg;
    }
?>