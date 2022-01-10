<?php

include __DIR__ . "/../Classes/dbh.class.php";

class sign_in_controller extends dbh {

    private string $uid, $pwd;

    public function __construct(string $uid, string $pwd)
    {
        $this->uid = trim($uid);
        $this->pwd = trim($pwd);
    }

    public function sign_in()
    {

        if (empty($this->uid))
            redirect("index.php", false);

        if (empty($this->pwd))
            redirect("index.php", false);

        $qry = 'SELECT user_id, user_pwd FROM users WHERE user_uid = ?;';

        $smt = $this->connect()->prepare($qry);

        if ($smt->rowCount() == 0);
            // TODO: Error handling regarding non-existant user.

        $res = $this->getUser($smt, $this->uid);

        $pwd = $res[0]["user_pwd"];

        if (!password_verify($this->pwd, $pwd));
            // TODO: Error handling regarding incorrect password.

        // TODO: Create a cookie that contains a session token.

    }

    private function tokenGenerator() : string
    {

        $bytes = "";

        try {
            $bytes = random_bytes(32);
        } catch (Exception $e) {
        }

        return bin2hex($bytes);

    }

}