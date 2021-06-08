<?php

require_once 'Roles.php';
require_once "User.php";
require_once "Session.php";

class Authorization {

    const MEMBER = 'membre'; /** @var string <p> represent member permission</p> */
    const STAFF = 'staff'; /** @var string <p> represent staff permission</p> */

    /**
     * <p> Allow certain user </p>
     * @param String $permission <p> a constant from authorization</p>
     * @param callable|null $fallback <p> function call when <strong>not allowed</strong> </p>
     * @return no-return
     */
    public static function allow(string $permission, callable $fallback = null)
    {

        $user = User::withID($_SESSION[Session::ID]);
        $mandatoryPower = Roles::withRole($permission)['power'];

        $userPower = Roles::withID($user['role_id'])['power'];

        if($mandatoryPower > $userPower) $fallback ? $fallback() : header('Location: /') or die;
    }


}
