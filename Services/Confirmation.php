<?php

class validation
{

    /**
     * Returns true if data is empty.
     * @param $uid
     * @param $pwd
     * @param $type
     * @return bool
     */

    public function is_valid($uid, $pwd, $type): bool
    {

        $trimmed_uid = trim($uid);
        $trimmed_pwd = trim($pwd);

        if (empty($trimmed_uid) && empty($trimmed_pwd)) {

            $_SESSION["error"] = "EMPTY_INPUT";
            return false;

        }

        if (empty(trim($uid))) {

            $_SESSION["error"] = "EMPTY_USERNAME";
            return false;

        }

        if (empty(trim($pwd))) {

            $_SESSION["error"] = "EMPTY_PASSWORD";
            return false;

        }

        $uppercase = preg_match('/[A-Z]/', $pwd);
        $lowercase = preg_match('/[a-z]/', $pwd);

        $decimal = preg_match('/[0-9]/', $pwd);
        $special = preg_match('/[^\w]/', $pwd);

        $length = strlen($trimmed_pwd) >= 8;

        if ((!$length || !$uppercase || !$lowercase || !$decimal || !$special) && $type === "REGISTER") {

            $_SESSION["error"] = "WEAK_PASSWORD";
            return false;

        }

        return true;

    }

}