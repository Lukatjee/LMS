<?php

session_start();

class Login extends DBH {

    public function get($uid, $pwd) {

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

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $match = preg_match($res[0], $pwd);

        if ($match == false) {

            $stmt = null;

            $_SESSION['error'] = "LOGIN_INVALID_PASSWORD";
            header("location: ../index.php");

            exit();

        }

        $stmt = $this->connect()->prepare('SELECT user_id FROM users WHERE user_uid = ?;');

        if (!$stmt->execute([$uid, $pwd])) {

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

        $_SESSION["user_id"] = $cred[0]["user_id"];
        $_SESSION["user_uid"] = $cred[0]["user_uid"];

        $stmt = null;

    }

}