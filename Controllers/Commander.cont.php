<?php

$dir = dirname(__FILE__);

include_once "$dir/../Classes/Commander.class.php";
include_once "$dir/../Services/Confirmation.php";

class commander_controller extends commander
{

    private string $uid;

    public function __construct($uid)
    {
        $this->uid = $uid;
    }

    /**
     * Check and convert the entered date before creating a new user.
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
        $commander = "false";

        if ($cmd === "on") $commander = "true";

        $this->create(trim($uid), $hashed_pwd, $commander);

    }

    public function get_admin(): bool
    {
        return $this->is_commander($this->uid);
    }

}