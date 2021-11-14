<?php

session_start();

class LoginController extends Login
{

    private $uid, $pwd;
    private $error;

    public function __construct($uid, $pwd)
    {

        $this->uid = $uid;
        $this->pwd = $pwd;

    }

    public function auth()
    {

        if ($this->isEmpty()) {

            $_SESSION['error'] = $this->error;
            header("location: ../index.php");

            exit();

        }

        $this->get($this->uid, $this->pwd);

    }

    /**
     * Returns true if data is empty.
     * @return bool
     */

    private function isEmpty()
    {

        if (empty(trim($this->uid)) && empty(trim($this->pwd))) {

            $this->error = "LOGIN_EMPTY_INPUT";
            return true;

        }

        if (empty(trim($this->uid))) {

            $this->error = "LOGIN_EMPTY_USERNAME";
            return true;

        }

        if (empty(trim($this->pwd))) {

            $this->error = "LOGIN_EMPTY_PASSWORD";
            return true;

        }

        return false;

    }

}