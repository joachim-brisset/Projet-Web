<?php
require_once "../models/Session.php";
require_once "../models/User.php";

class Authentication {

    const AUTH_DISABLED = 0; /** @var int <p> Authentication system disabled </p>*/
    const AUTH_NONE = 1; /** @var int <p> Not used </p>*/
    const AUTH_EXPIRED = 2; /** @var int <p> Authentication time expired </p>*/

    const INVALID_SESSION = 3; /** @var int <p> /** @var int <p> Authentication invalid </p>*/
    const INVALID_USER = 4; /** @var int <p> /** @var int <p> Authentication invalid </p>*/

    const NOT_AUTH = 5; /** @var int <p> Not Authenticated </p>*/
    const INVALID_PASS = 6; /** @var int <p>Wrong password </p>*/

    const ALREADY_REGISTERED = 7; /** @var int <p> Anthentication already used </p>*/
    const NOT_CREATED = 10; /** @var int <p> Authentication failed </p> */


    /**
     * <p> check if the current session is authenticated. <br/> Start the session if not started</p>
     * @return array <p> ['auth' => bool, 'error' => int|null] </p>
     */
    static function isAuth (): array
    {
        if (session_status() == PHP_SESSION_DISABLED) return ["auth" => false, "error" => self::AUTH_DISABLED];
        if (session_status() == PHP_SESSION_NONE) session_start();

        if (isset($_SESSION[Session::LOGGED]) and $_SESSION[Session::LOGGED]) {
            if (!Session::isValid()) return ["auth" => false, "error" => self::INVALID_SESSION];
            if (Session::isExpired()) return ["auth" => false, "error" => self::AUTH_EXPIRED];

            return User::existWithID($_SESSION[Session::ID]) ?
                ["auth" => true, "error" => null] : ["auth" => false, "error" => self::INVALID_USER];
        }
        return ["auth" => false, "error" => self::NOT_AUTH];
    }

    /**
     * <p> Try to anthenticate the current Session with the $mail and $pass </p>
     * @param $mail <p> the mail to authenticate with </p>
     * @param $pass <p> the password to authenticate with the mail
     * @return array <p> ['auth' => bool, 'error' => int|null, "until" => datetime] until is return only if auth is true</p>
     */
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

    /**
     * <p> Try to register a new account with $mail and $pass and authenticate the current Session with this account
     * @param $mail <p> the mail to register with </p>
     * @param $pass <p> the password to register with the mail
     * @return array <p> ['auth' => bool, 'error' => int|null] <p>
     */
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
                return ["auth" => true, "error" => null];
            } else
                return ["auth" => false, "error" => self::NOT_CREATED];
        } else
            return ["auth" => false, "error" => self::ALREADY_REGISTERED];
    }
}
