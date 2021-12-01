<?php

include_once dirname(__FILE__) . "/../Classes/Commander.class.php";
include_once dirname(__FILE__) . "/../Services/Confirmation.php";

class commander_controller extends commander
{

    private string $uid;

    public function __construct($uid)
    {
        $this->uid = $uid;
    }

    public function create_user($uid, $pwd, $cmd) {

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