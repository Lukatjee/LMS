<?php

include __DIR__ . "/../Classes/dbh.class.php";

class sign_in_controller extends dbh {

    public function signIn(string $uid, string $pwd)
    {

        if (empty($uid))
            redirect("index.php", false);

        if (empty($pwd))
            redirect("index.php", false);

        $qry = 'SELECT user_id, user_pwd FROM users WHERE user_uid = ?;';

        $smt = $this->connect()->prepare($qry);

        if ($smt->rowCount() == 0);
            // TODO: Error handling regarding non-existant user.

        $res = $this->getUser($smt, $uid);

        $hsh = $res[0]["user_pwd"];

        if (!password_verify($pwd, $hsh));
            // TODO: Error handling regarding incorrect password.

        $token = $this->tokenGenerator();

        $this->updateSession($uid, $token);
        setcookie('token', $token, time() + 86400);

    }

    private function tokenGenerator() : string
    {

        try {

            $bytes = random_bytes(32);
            return bin2hex($bytes);

        } catch (Exception $e) {

            exit();

        }

    }

}