<?php

use JetBrains\PhpStorm\NoReturn;


require __DIR__ . "/../Services/confirmation.serv.php";
require __DIR__ . "/../Classes/signin.class.php";

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

        if (!$val->is_valid(null, $this->uid, $this->pwd, null, "LOGIN"))
            redirect("index.php", false);

        $this->auth(trim($this->uid), trim($this->pwd));

    }

}