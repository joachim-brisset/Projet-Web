<?php

class Session
{
    const ID = "id";
    const VALID_UNTIL = "until";
    const LOGGED = "logged";

    const HISTORY = "history";


    static function isValid(): bool
    {
        return isset($_SESSION[self::ID]) AND isset($_SESSION[self::VALID_UNTIL]) AND isset($_SESSION[self::LOGGED]);
    }

    static function extendValidity(int $seconds = null) {
        $_SESSION[Session::VALID_UNTIL] = (new DateTime())->add(new DateInterval("PT" . ($seconds ?: Variables::SESSION_VALID_TIMEOUT) . "S"));
    }
    static function isExpired() {
        return new Datetime() > $_SESSION[Session::VALID_UNTIL];
    }

    static function appendToHistory($url = null) {
        if(session_status() == PHP_SESSION_NONE) session_start();

        $array = $_SESSION[Session::HISTORY] ?? [];
        $length = sizeof($array);
        $lastUrl = $length > 0 ? $array[$length -1] : null;

        if ($lastUrl != $_SERVER['REQUEST_URI']) {
            array_push($array, $url ?: $_SERVER['REQUEST_URI']);
            $_SESSION[Session::HISTORY] = $array;
        }
    }
    static function popHistory() {
        $array = $_SESSION[Session::HISTORY] ?? [];
        return array_pop($array);
    }
}