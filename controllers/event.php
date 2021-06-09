<?php

require_once "../models/Event.php";
require_once "../models/Registration.php";
require_once "../models/Authentication.php";

if (Authentication::isAuth()['auth']) Session::extendValidity();

$event = Event::withID($_GET['event_id']);
$registrationNumber = sizeof(Registration::with(['event_id' => $event['id']]));

$full = $event['place_number'] != 0 && $event['place_number'] <= $registrationNumber;
$unregistered = !Authentication::isAuth()['auth'] || empty(Registration::with(['event_id' => $event['id'], 'user_id' => $_SESSION[Session::ID]]));

$oneDayEvent = $event['end_at'] == "0000-00-00" || $event['end_at'] == $event['start_at'];
$seats = !empty($event['place_number']) ? $event['place_number'] : "illimité";
include "../views/event.php";