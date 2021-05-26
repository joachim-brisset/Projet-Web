<?php class Autorization
{

    const SELF = 0;
    const MEMBER = 1;
    const STAFF = 2;

    public static function allow($permission, $fallback = null)
    {
        $user = User::withID($_SESSION[Session::ID]);

        !$fallback ?: $fallback();
    }

}
