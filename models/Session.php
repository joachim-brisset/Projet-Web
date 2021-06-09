<?php

class Session
{
    const ID = "id"; /** @var string define key for storing the id in session global variable */
    const VALID_UNTIL = "until"; /** @var string define key for storing the authentication dead line in session global variable */
    const LOGGED = "logged"; /** @var string define key for storing the current state of authentication in session global variable */

    const HISTORY = "history"; /** @var string define key for storing the history in session global variable */


    /**
     * <p> Check if Session is valid </p>
     * @return bool <p>return true if valid false otherwise</p>
     */
    static function isValid(): bool
    {
        return isset($_SESSION[self::ID]) AND isset($_SESSION[self::VALID_UNTIL]) AND isset($_SESSION[self::LOGGED]);
    }

    /**
     * <p> Add time to authentication dead line </p>
     * @param int|null $seconds <p> time in second to extend the dead line. if null if will use the default value define ei Variable.php. Default: null</p>
     * @throws Exception
     */
    static function extendValidity(int $seconds = null) {
        $_SESSION[Session::VALID_UNTIL] = (new DateTime())->add(new DateInterval("PT" . ($seconds ?: Variables::SESSION_VALID_TIMEOUT) . "S"));
    }

    /**
     * <p> Check if a authentication is expired </p>
     * @return bool <p> return true if expired and false otherwise </p>
     */
    static function isExpired() {
        return new Datetime() > $_SESSION[Session::VALID_UNTIL];
    }

    /**
     * <p> Store the current page in the history of the Session </p>
     * @param string|null $url <p> the url to store. If null store the current page url. Default: null</p>
     */
    static function appendToHistory(string $url = null) {
        if(session_status() == PHP_SESSION_NONE) session_start();

        $array = $_SESSION[Session::HISTORY] ?? [];
        $length = sizeof($array);
        $lastUrl = $length > 0 ? $array[$length -1] : null;

        if ($lastUrl != $_SERVER['REQUEST_URI']) {
            array_push($array, $url ?: $_SERVER['REQUEST_URI']);
            $_SESSION[Session::HISTORY] = $array;
        }
    }

    /**
     * <p> Remove and get the last page viewed ans stored in history
     * @return mixed <p> return the url of the last page viewed ans stored </p>
     */
    static function popHistory() {
        $array = $_SESSION[Session::HISTORY] ?? [];
        return array_pop($array);
    }
}