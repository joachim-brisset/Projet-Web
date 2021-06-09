<?php
require_once "../Variables.php";
require_once "../models/Authentication.php";
require_once "../models/User.php";

if (Authentication::isAuth()['auth']){
    if(!User::isComplete($_SESSION[Session::ID])) header('Location: /complete_data');
    Session::extendValidity();
}

if($_SERVER['REQUEST_METHOD'] == "POST" || !isset($_GET['search'])) {
    header('Location: /');
}

$searchUser = isset($_GET['users-checkbox']);
$searchProduct = isset($_GET['products-checkbox']);
$searchEvent = isset($_GET['events-checkbox']);

$query = $_GET['search'];
if($query != "") {
    try {
        $query = (new DateTime($query))->format('Y-m-d');
    } catch (Exception $e) {};
}

$forceSearch = !$searchEvent AND !$searchProduct AND !$searchUser;

$db = new PDO('mysql:host=localhost;dbname=' . Variables::MYSQL_DATABASE, Variables::MYSQL_USER , Variables::MYSQL_PASS);

if ($searchUser OR $forceSearch) {
    $req = $db->prepare("SELECT user_id FROM `usersearch` WHERE search_fields LIKE :query");

    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->bindValue( ":query", '%' . $query . '%', PDO::PARAM_STR);

    $req->execute();
    $result = $req->fetchAll();

    $req = $db->prepare("SELECT * FROM users WHERE id IN (" . implode(',', array_map(function ($x) { return $x['user_id'];}, $result)) . ") LIMIT 5" );
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->execute();
    $result = $req->fetchAll();

    $userResult = array_map(function ($x) { $x['type'] = 'user'; return $x;}, $result);
}
if ($searchProduct OR $forceSearch) {
    $req = $db->prepare("SELECT product_id FROM `productsearch` WHERE search_fields LIKE :query");

    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->bindValue( ":query", '%' . $query . '%', PDO::PARAM_STR);

    $req->execute();
    $result = $req->fetchAll();

    $req = $db->prepare("SELECT * FROM products WHERE id IN (" . implode(',', array_map(function ($x) { return $x['product_id'];}, $result)) . ") LIMIT 5" );
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->execute();
    $result = $req->fetchAll();

    $productResult = array_map(function ($x) { $x['type'] = 'product'; return $x;}, $result);
}
if ($searchEvent OR $forceSearch) {
    $req = $db->prepare('SELECT event_id FROM `eventsearch` WHERE (search_fields LIKE :query OR :date BETWEEN start_date AND end_date)');

    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->bindValue( ":query", '%' . $query . '%', PDO::PARAM_STR);
    $req->bindValue( ":date", $query, PDO::PARAM_STR);

    $req->execute();
    $result = $req->fetchAll();

    $req = $db->prepare("SELECT * FROM events WHERE id IN (" . implode(',', array_map(function ($x) { return $x['event_id'];}, $result)) . ") LIMIT 5" );
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->execute();
    $result = $req->fetchAll();

    $eventResult = array_map(function ($x) { $x['type'] = 'event'; return $x;}, $result);

}

require "../views/search.php";
