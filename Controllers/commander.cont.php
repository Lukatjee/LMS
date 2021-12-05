<?php

use JetBrains\PhpStorm\NoReturn;

require __DIR__ . "/../Classes/Commander.class.php";
require __DIR__ . "/../Services/confirmation.serv.php";

class commander_controller extends commander
{

    private string $uid;

    /**
     * Controller for the commander page.
     * @param $uid
     */

    public function __construct($uid)
    {
        $this->uid = $uid;
    }

    /**
     * Check and convert the given data before creating a new user.
     * @param $eml
     * @param $uid
     * @param $pwd
     * @param $role
     * @param $cls
     */

    #[NoReturn] public function new($eml, $uid, $pwd, $role, $cls)
    {

        $val = new validation();

        if (!$val->is_valid($eml, $uid, $pwd, $cls, "REGISTER")) {

            header("location: ./_adduser.php");
            exit();

        }

        $hashed_pwd = password_hash(trim($pwd), PASSWORD_DEFAULT);

        $this->create($eml, trim($uid), $hashed_pwd, $role, $cls);

    }

    /**
     * Returns true if the user is a commander.
     * @return bool
     */

    public function get_is_admin(): bool
    {
        return $this->is_commander($this->uid);
    }

}