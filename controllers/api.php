<?php

require_once "../models/Event.php";
require_once "../models/Authorization.php";
require_once "../models/Authentication.php";
require_once "../models/Registration.php";
require_once "../models/Product.php";
require_once "../views/fonctions-panier.php";


/* TODO: checks var types */

$api = [
    'getNews' => function($params) {
        $input = json_decode($params, true);
        if (!$input) return ["error" => "value malformated: not a json"];

        if (isset($input['number'])) {
            if (is_numeric($input['number'])) {
                $temp = [];
                for ($i = 0; $i < $input['number']; $i++) array_push($temp, "test");
                return $temp;
            } else return ["error" => "number must be a number"];
        } else return ["error" => "number must be defined"];
    },

    'addNews' => function($params) {

    },

    'unregisterEvent' => function() {
        if (!Authentication::isAuth()['auth']) return ['success' => false, 'cause' => "not auth"];
        if (!isset($_GET['event_id'])) return ['success' => false, 'cause' => 'no user_id parameter'];

        if (isset($_GET['user_id'])) {
            Authorization::allow(Authorization::STAFF, function () {die;});
            return ['success' => Registration::unregister($_GET['event_id'], $_GET['user_id']), 'cause' => 'sql'];
        } else {
            return ['success' => Registration::unregister($_GET['event_id'], $_SESSION[Session::ID]), 'cause' => 'sql'];
        }
    },

    'registerEvent' => function() {
        if (!Authentication::isAuth()['auth']) return ['success' => false, 'cause' => "not auth"];
        if (!isset($_GET['event_id'])) return ['success' => false, 'cause' => 'no user_id parameter'];

        if (isset($_GET['user_id'])) {
            Authorization::allow(Authorization::STAFF, function () {die;});
            return ['success' => Registration::register($_GET['event_id'], $_GET['user_id']), 'cause' => 'sql'];
        } else {
            if (Event::withID($_GET['event_id'])['place_number'] > sizeof(Registration::with(['event_id' => $_GET['event_id']]))) {
                return ['success' => Registration::register($_GET['event_id'], $_SESSION[Session::ID]), 'cause' => 'sql'];
            } else {
                return ['success' => false, 'cause' => 'Full'];
            }
        }
    },

    'addProductToCart' => function()  {
        if (!Authentication::isAuth()['auth']) return ['success' => false, 'cause' => "not auth"];
        if(!isset($_GET["ProductId"])||!isset($_GET["qqte"])) return['success' => false , 'cause' => "missing parameters"];
        return ['success'=>ajouterArticle($_GET["ProductId"],$_GET["qqte"])];
    },
    'clearCart' => function () {
        if (!Authentication::isAuth()['auth']) return ['success' => false, 'cause' => "not auth"];
        supprimePanier();
        return ['success' => true];
    },
    'changeProductQuantity' => function() {
        if (!Authentication::isAuth()['auth']) return ['success' => false, 'cause' => "not auth"];
        if(!isset($_GET["productId"])||!isset($_GET["qte"])) return['success' => false , 'cause' => "missing parameters"];
        return ['success' => modifierQTeArticle($_GET["productId"], $_GET["qte"])];
    },
    'getCartAmount' => function() {
        if (!Authentication::isAuth()['auth']) return ['success' => false, 'cause' => "not auth"];
        return ['success' => true, "value" => MontantGlobal()];
    },

    'getAllEvent' => function() {
        return Event::all();
    },

    'addEvent' => function() {
        if (!Authentication::isAuth()['auth']) return ['success' => false, "cause" => "not connected"];
        Authorization::allow(Authorization::STAFF, function() {die;});

        if (!isset($_GET['event_name']) || !isset($_GET['event_desc']) || !isset($_GET['event_place']) || !isset($_GET['event_start']) || !isset($_GET['event_end']) || !isset($_GET['event_price']) || !isset($_GET['event_place_number'])) return ['success' => false, 'cause' => 'not enough arguments'];

        $params = [];
        $params['name'] = $_GET['event_name'];
        $params['description'] = $_GET['event_desc'];
        $params['place'] = $_GET['event_place'];
        $params['start_at'] = $_GET['event_start'] != "" ? $_GET['event_start'] : 0;
        $params['end_at'] = $_GET['event_end'] != "" ? $_GET['event_end'] : 0;
        $params['price'] = $_GET['event_price'] != "" ? $_GET['event_price'] : 0;
        $params['place_number'] = $_GET['event_place_number'] != "" ? $_GET['event_place_number'] : 0;
        $params['event_cost'] = $_GET['event_cost'] != "" ? $_GET['event_cost'] : 0;

        return ['success' => Event::add($params), 'cause' => 'sql'];
    },

    'getEvent' => function() {
        if(!isset($_GET['event_id'])) return ['success' => false, 'cause' => 'no id'];
        return Event::withID($_GET['event_id']);
    },

    'editEvent' => function() {

        if (!Authentication::isAuth()['auth']) return ['success' => false, "cause" => "not connected"];
        Authorization::allow(Authorization::STAFF, function() {die;});

        if(!isset($_GET['event_id']) || !(isset($_GET['event_name']) || isset($_GET['event_desc']) || isset($_GET['event_place']) || isset($_GET['event_start']) || isset($_GET['event_end'])) ) return ['success' => false, 'cause' => 'not enough arguments'];

        $params = [];
        if (isset($_GET['event_name'])) $params['name'] = $_GET['event_name'];
        if (isset($_GET['event_desc'])) $params['description'] = $_GET['event_desc'];
        if (isset($_GET['event_place'])) $params['place'] = $_GET['event_place'];
        if (isset($_GET['event_start'])) $params['start_at'] = $_GET['event_start'];
        if (isset($_GET['event_end'])) $params['end_at'] = $_GET['event_end'];
        if (isset($_GET['event_price'])) $params['price'] = $_GET['event_price'];
        if (isset($_GET['event_place_number'])) $params['place_number'] = $_GET['event_place_number'];
        if (isset($_GET['event_cost'])) $params['event_cost'] = $_GET['event_cost'];

        return ['success' => Event::update(['id' => $_GET['event_id']], $params), 'cause' => 'sql'];
    },

    'deleteEvent' => function() {
        if (!Authentication::isAuth()['auth']) return ['success' => false, "cause" => "not connected"];
        Authorization::allow(Authorization::STAFF, function() {die;});

        if(!isset($_GET['event_id'])) return ['success' => false, 'cause' => 'no event_id'];
        return ['success' => Event::delete($_GET['event_id']), 'cause' => 'sql'];

    },

    'addProduct' => function() {
        if (!Authentication::isAuth()['auth']) return ['success' => false, "cause" => "not connected"];
        Authorization::allow(Authorization::STAFF, function() {die;});

        if(!isset($_GET['product_name']) || !isset($_GET['product_price']) || !isset($_GET['product_stocks']) ||!isset($_GET['product_initial_stock'])) return ['success' => false, 'cause' => "missing parameters"];

        $params = [];
        $params['name'] = $_GET['product_name'];
        $params['price'] = $_GET['product_price'];
        $params['stocks'] = $_GET['product_stocks'];
        $params['initial_stock'] = $_GET['product_initial_stock'];

        return [ 'success' => Product::add($params), 'cause' => 'sql'];
    },

    'getProduct' => function() {
        if(!isset($_GET['product_id'])) return ['success' => false, 'cause' => 'no id'];
        return Product::withID($_GET['product_id']);
    },

    'editProduct' => function() {
        if (!Authentication::isAuth()['auth']) return ['success' => false, "cause" => "not connected"];
        Authorization::allow(Authorization::STAFF, function() {die;});

        if (!isset($_GET['product_id']) || !(isset($_GET['product_name']) || isset($_GET['product_price']) ||isset($_GET['product_stocks']) || isset($_GET['product_initial_stock']))) return ['success' => false, 'cause' => 'missing parameters'];

        $params = [];
        if (isset($_GET["product_name"])) $params["name"] = $_GET["product_name"];
        if (isset($_GET["product_price"])) $params["price"] = $_GET["product_price"];
        if (isset($_GET["product_stocks"])) $params["stocks"] = $_GET["product_stocks"];
        if (isset($_GET["product_initial_stock"])) $params["initial_stock"] = $_GET["product_initial_stock"];

        return ['success' => Product::update(['id' => $_GET["product_id"]], $params), 'cause' => 'sql'];
    },

    'deleteProduct' => function() {
        if (!Authentication::isAuth()['auth']) return ['success' => false, "cause" => "not connected"];
        Authorization::allow(Authorization::STAFF, function() {die;});

        if(!isset($_GET['product_id'])) return ['success' => false, 'cause' => 'no event_id'];
        return ['success' => Product::delete($_GET['product_id']), 'cause' => 'sql'];
    },
    
    'addUser' => function() {
        if (!Authentication::isAuth()['auth']) return ['success' => false, "cause" => "not connected"];
        Authorization::allow(Authorization::STAFF, function() {die;});

        if (!isset($_GET['user_username']) || !isset($_GET['user_mail']) || !isset($_GET['user_firstname']) || !isset($_GET['user_lastname']) || !isset($_GET['user_gender']) || !isset($_GET['user_birth_day']) || !isset($_GET['user_jobs']) || !isset($_GET['user_street_number']) || !isset($_GET['user_street']) || !isset($_GET['user_cp']) || !isset($_GET['user_city']) || !isset($_GET['user_country']) || !isset($_GET["user_role_id"])) return ['success' => false, 'cause' => "missing parameters"];

        $params = [];
        $params['username'] = $_GET['user_username'];
        $params['mail'] = $_GET['user_mail'];
        $params['firstname'] = $_GET['user_firstname'];
        $params['lastname'] = $_GET['user_lastname'];
        if ($_GET["user_role_id"] == "membre") {
            $params['role_id'] = 1;
        }
        elseif ($_GET["user_role_id"] == "staff") {
            $params['role_id'] = 2;
        }
        elseif ($_GET["user_role_id"] == "aucun rôle") {
            $params['role_id'] = NULL;
        }
        $params['gender'] = $_GET['user_gender'];
        $params['jobs'] = $_GET['user_jobs'];
        $params['street_number'] = $_GET['user_street_number'];
        $params['street'] = $_GET['user_street'];
        $params['cp'] = $_GET['user_cp'];
        $params['city'] = $_GET['user_city'];
        $params['country'] = $_GET['user_country'];
        $params['birth_day'] = $_GET['user_birth_day'];

        return [ 'success' => User::add($params), 'cause' => 'sql'];
    },

    'getUser' => function() {
        if(!isset($_GET['user_id'])) return ['success' => false, 'cause' => 'no id'];
        return User::withID($_GET['user_id']);
    },

    'editUser' => function() {
        if (!Authentication::isAuth()['auth']) return ['success' => false, "cause" => "not connected"];
        Authorization::allow(Authorization::STAFF, function() {die;});

        if (!isset($_GET['user_id']) || !isset($_GET["user_role_id"]) || !(isset($_GET['user_username']) || isset($_GET['user_mail']) || isset($_GET['user_firstname']) || isset($_GET['user_lastname']) || isset($_GET['user_gender']) || isset($_GET['user_birth_day']) || isset($_GET['user_jobs']) || isset($_GET['user_street_number']) || isset($_GET['user_street']) || isset($_GET['user_cp']) || isset($_GET['user_city']) || isset($_GET['user_country']))) return ['success' => false, 'cause' => "missing parameters"];
        
        $params = [];
        if (isset($_GET["user_username"])) $params['username'] = $_GET['user_username'];
        if (isset($_GET["user_mail"])) $params['mail'] = $_GET['user_mail'];
        if (isset($_GET["user_firstname"])) $params['firstname'] = $_GET['user_firstname'];
        if (isset($_GET["user_lastname"])) $params['lastname'] = $_GET['user_lastname'];
        if (isset($_GET["user_role_id"])) {
            if ($_GET["user_role_id"] == "membre") {
                $params['role_id'] = 1;
            }
            elseif ($_GET["user_role_id"] == "staff") {
                $params['role_id'] = 2;
            }
        }
        if (isset($_GET["user_gender"])) $params['gender'] = $_GET['user_gender'];
        if (isset($_GET["user_jobs"])) $params['jobs'] = $_GET['user_jobs'];
        if (isset($_GET["user_street_number"])) $params['street_number'] = $_GET['user_street_number'];
        if (isset($_GET["user_street"])) $params['street'] = $_GET['user_street'];
        if (isset($_GET["user_cp"])) $params['cp'] = $_GET['user_cp'];
        if (isset($_GET["user_city"])) $params['city'] = $_GET['user_city'];
        if (isset($_GET["user_country"])) $params['country'] = $_GET['user_country'];
        if (isset($_GET["user_birth_day"])) $params['birth_day'] = $_GET['user_birth_day'];

        return ['success' => User::update(['id' => $_GET["user_id"]], $params), 'cause' => 'sql', 'test' => $params];
    },

    'deleteUser' => function() {
        if (!Authentication::isAuth()['auth']) return ['success' => false, "cause" => "not connected"];
        Authorization::allow(Authorization::STAFF, function() {die;});

        if(!isset($_GET['user_id'])) return ['success' => false, 'cause' => 'no event_id'];
        return ['success' => User::delete($_GET['user_id']), 'cause' => 'sql'];
    },
];

if(isset($_GET['action'])) {
    header('Content-type: application/json');
    try {
        echo json_encode( isset($api[$_GET['action']]) ? $api[$_GET['action']]($_GET['value'] ?? "") : "" );
    } catch (Exception $e) {
    }
}
