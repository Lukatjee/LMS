<?php

$dir = dirname(__FILE__);

include_once "$dir/../Classes/Commander.class.php";
include_once "$dir/../Services/Confirmation.php";

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
     * @param $uid
     * @param $pwd
     * @param $cmd
     */

    public function create_user($uid, $pwd, $cmd)
    {

        $val = new validation();

        if (!$val->is_valid($uid, $pwd, "REGISTER")) {

            header("location: ./index.php");
            exit();

        }

        $hashed_pwd = password_hash(trim($pwd), PASSWORD_DEFAULT);
        $commander = 0;

        if ($cmd === "on") $commander = 1;

        $this->create(trim($uid), $hashed_pwd, $commander);

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