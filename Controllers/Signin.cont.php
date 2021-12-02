<?php

use JetBrains\PhpStorm\NoReturn;

define("DIR", dirname(__FILE__));

include_once DIR . "/../Services/Confirmation.php";
include_once DIR . "/../Classes/Signin.class.php";

class sign_in_controller extends sign_in
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
     * Check whether the credentials are valid.
     */

    #[NoReturn] public function validate()
    {

        $val = new validation();

        if (!$val->is_valid($this->uid, $this->pwd, "LOGIN"))
            redirect("index.php", false);

        $this->auth(trim($this->uid), trim($this->pwd));

    }

}