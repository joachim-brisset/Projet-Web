<?php

require_once "../models/Event.php";
require_once "../models/Authorization.php";
require_once "../models/Authentication.php";
require_once "../models/Registration.php";

/* TODO */

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

        return ['test'=> $_GET['event_end'],'success' => Event::update(['id' => $_GET['event_id']], $params), 'cause' => 'sql'];
    }
];

if(isset($_GET['action'])) {
    header('Content-type: application/json');
    try {
        echo json_encode( isset($api[$_GET['action']]) ? $api[$_GET['action']]($_GET['value'] ?? "") : "" );
    } catch (Exception $e) {
    }
}
