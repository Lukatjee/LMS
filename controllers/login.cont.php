<?php

session_start();
include "Services/Confirmation.php";
include "Classes/login.php";

class login_controller extends login
{

    private string $uid, $pwd;

    /**
     * Controller for the sign in system.
     * @param $uid
     * @param $pwd
     */

    public function __construct($uid, $pwd)
    {

        $this->uid = $uid;
        $this->pwd = $pwd;

    }

    /**
     * Check the given credentials to sign the user in.
     */

    public function authenticate()
    {

        $val = new validation();

        if (!$val->is_valid($this->uid, $this->pwd, "LOGIN"))
            redirect("index.php");

        $this->get($this->uid, $this->pwd);

    }

}