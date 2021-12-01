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

        $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
        $cmd_val = "false";

        if ($cmd === "on") $cmd_val = "true";

        $this->create($uid, $pwd_hash, $cmd_val);

    }

    public function get_admin(): bool
    {
        return $this->is_commander($this->uid);
    }

}