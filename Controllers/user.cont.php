<?php

use JetBrains\PhpStorm\NoReturn;

require __DIR__ . "/../Classes/dbh.class.php";

class commander_controller extends dbh
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

    #[NoReturn] public function createUser($eml, $uid, $pwd, $role, $cls)
    {

        if (password_is_valid(trim($pwd))) {

            header("location: ./_adduser.php");
            exit();

        }

        $stmt = $this->connect()->prepare('SELECT user_id FROM users WHERE user_uid = ? OR email = ?;');

        $res = $this->exists($stmt, $uid, $eml);

        if ($res) {

            $_SESSION["error"] = "USER_EXISTS";
            redirect("Templates/Commander/Users/_adduser.php", false);

        }

        $stmt = $this->connect()->prepare('INSERT INTO users(email, user_uid, user_pwd, role, class) VALUES(?, ?, ?, ?, ?);');

        $this->createUser($stmt, $eml, $uid, password_hash($pwd, PASSWORD_DEFAULT), $role, $cls);

    }

    /**
     * Fetch all the users from the database.
     * @return array
     */

    public function fetch(): array
    {

        $stmt = $this->connect()->prepare('SELECT * FROM users;');

        return $this->getUsers($stmt);

    }

    /**
     * Returns true if the user is a commander.
     * @return bool
     */

    public function get_is_admin(): bool
    {
        return $this->is_commander($this->uid);
    }

    function password_is_valid($pwd): bool
    {

        $upc = preg_match('/[A-Z]/', $pwd);
        $lwc = preg_match('/[a-z]/', $pwd);
        $dcl = preg_match('/[0-9]/', $pwd);
        $spc = preg_match('/[^\w]/', $pwd);

        $len = strlen($pwd) >= 8;

        if (!$upc)
            return false;

        if (!$lwc)
            return false;

        if (!$dcl)
            return false;

        if (!$spc)
            return false;

        if (!$len)
            return false;

        return true;

    }

}