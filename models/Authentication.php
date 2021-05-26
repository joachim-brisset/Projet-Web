<?php
require_once "../models/Session.php";
require_once "../models/User.php";

class Authentication {

    const AUTH_DISABLED = 0;
    const AUTH_NONE = 1;
    const AUTH_EXPIRED = 2;

    const INVALID_SESSION = 3;
    const INVALID_USER = 4;

    const NOT_AUTH = 5;
    const INVALID_PASS = 6;

    const ALREADY_REGISTERED = 7;
    const NOT_CREATED = 10;


    static function isAuth (): array
    {
        if (session_status() == PHP_SESSION_DISABLED) return ["auth" => false, "error" => self::AUTH_DISABLED];
        if (session_status() == PHP_SESSION_NONE) session_start();

        if (isset($_SESSION[Session::LOGGED]) and $_SESSION[Session::LOGGED]) {
            if (!Session::isValid()) return ["auth" => false, "error" => self::INVALID_SESSION];
            if (Session::isExpired()) return ["auth" => false, "error" => self::AUTH_EXPIRED];

            return User::existWithID($_SESSION[Session::ID]) ?
                ["auth" => true] : ["auth" => false, "error" => self::INVALID_USER];
        }
        return ["auth" => false, "error" => self::NOT_AUTH];
    }

    static function auth($mail, $pass): array
    {
        if (session_status() == PHP_SESSION_DISABLED) return ["auth" => false, "error" => self::AUTH_DISABLED];
        if (session_status() == PHP_SESSION_NONE) session_start();

        $user = User::withMail($mail);
        if (!isset($user)) return ["auth" => false, "error" => self::INVALID_USER];

        if (password_verify($pass, $user["password"]) )
        {
            $_SESSION[Session::ID] = $user['id'];
            Session::extendValidity();

            $_SESSION[Session::LOGGED] = true;

            return ["auth" => true, "until" => $_SESSION[Session::VALID_UNTIL]];
        }
        else return ["auth" => false, "error" => self::INVALID_PASS];
    }

    public static function register($mail, $pass): array
    {
        if (session_status() == PHP_SESSION_DISABLED) return ["auth" => false, "error" => self::AUTH_DISABLED];
        if (session_status() == PHP_SESSION_NONE) session_start();

        $user = User::withMail($mail);
        if ($user == null) {
            $id = User::create($mail,$pass);

            if (is_numeric($id)) {
                $_SESSION[Session::ID] = $id;
                Session::extendValidity();

                $_SESSION[Session::LOGGED] = true;
                return ["auth" => true];
            } else
                return ["auth" => false, "error" => self::NOT_CREATED];
        } else
            return ["auth" => false, "error" => self::ALREADY_REGISTERED];
    }
}
