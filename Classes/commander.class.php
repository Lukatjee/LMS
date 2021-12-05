<?php

use JetBrains\PhpStorm\NoReturn;

require __DIR__ . "/dbh.class.php";

class commander extends dbh
{

    /**
     * Fetch all the users from the database.
     * @return array
     */

    public function fetch(): array
    {

        $stmt = $this->connect()->prepare('SELECT * FROM users;');

        return $this->get_users($stmt);

    }

    /**
     * Creates a user if the requirements have been met and the user does not exist yet.
     * @param $eml
     * @param $uid
     * @param $pwd
     * @param $role
     * @param $cls
     */

    #[NoReturn] public function create($eml, $uid, $pwd, $role, $cls)
    {

        $stmt = $this->connect()->prepare('SELECT user_id FROM users WHERE user_uid = ? OR email = ?;');

        $res = $this->exists($stmt, $uid, $eml);

        if ($res) {

            $_SESSION["error"] = "USER_EXISTS";
            redirect("Templates/Commander/Users/_adduser.php", false);

        }

        $stmt = $this->connect()->prepare('INSERT INTO users(email, user_uid, user_pwd, role, class) VALUES(?, ?, ?, ?, ?);');

        $this->create_user($stmt, $eml, $uid, $pwd, $role, $cls);

    }

}