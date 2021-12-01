<?php

use JetBrains\PhpStorm\NoReturn;

session_start();

include_once dirname(__FILE__) . "/../Services/Confirmation.php";
include_once dirname(__FILE__) . "/../Classes/Signin.class.php";

class signin_controller extends signin
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

    #[NoReturn] public function authenticate()
    {

        $val = new validation();

        if (!$val->is_valid($this->uid, $this->pwd, "LOGIN"))
            redirect("index.php", false);

        $this->get($this->uid, $this->pwd);

    }

}