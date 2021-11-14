<?php

class Login extends DBH
{

    /**
     * Retrieves the user from the database if they exist.
     * @param $uid
     * @param $pwd
     */

    public function get($uid, $pwd)
    {

        // Query database to check if the user exists, to then grab their password

        $stmt = $this->connect()->prepare('SELECT user_pwd FROM users WHERE user_uid = ?;');

        if (!$stmt->execute([$uid])) {

            $stmt = null;

            $_SESSION['error'] = "FAILED_CONNECTION";
            header("location: ../index.php");

            exit();

        }

        if ($stmt->rowCount() == 0) {

            $stmt = null;

            $_SESSION['error'] = "LOGIN_UNKNOWN_USER";
            header("location: ../index.php");

            exit();

        }

        // Check if the queried password matches the one the user entered

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $match = password_verify($pwd, $res[0]["user_pwd"]);


        if ($match == false) {

            $stmt = null;

            $_SESSION['error'] = "LOGIN_INVALID_PASSWORD";
            header("location: ../index.php");

            exit();

        }

        // Get the user id, start a session and redirect the user to the dashboard

        $stmt = $this->connect()->prepare('SELECT user_id FROM users WHERE user_uid = ?;');

        if (!$stmt->execute([$uid])) {

            $stmt = null;

            $_SESSION['error'] = "FAILED_CONNECTION";
            header("location: ../index.php");

            exit();

        }

        if ($stmt->rowCount() == 0) {

            $stmt = null;

            $_SESSION['error'] = "LOGIN_INVALID_CREDENTIALS";
            header("location: ../index.php");

            exit();

        }

        $cred = $stmt->fetchAll(PDO::FETCH_ASSOC);
<<<<<<< Updated upstream

        $_SESSION["user_id"] = $cred[0]["user_id"];
        $_SESSION["user_uid"] = $cred[0]["user_uid"];
=======

        $_SESSION["logged_in"] = true;
        $_SESSION["user_id"] = $cred[0]["user_id"];
        $_SESSION["user_uid"] = $uid;

        header("location: ../dashboard/index.php");
>>>>>>> Stashed changes

        $stmt = null;

    }

}