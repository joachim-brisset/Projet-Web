<?php

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

    }
];

if(isset($_GET['action'])) {
    header('Content-type: application/json');
    echo json_encode( $api[$_GET['action']]($_GET['value'] ?? "") );
}
