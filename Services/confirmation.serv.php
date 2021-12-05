<?php

class validation
{

    /**
     * Returns true if data is invalid.
     * @param $eml
     * @param $uid
     * @param $pwd
     * @param $cls
     * @param $type
     * @return bool
     */

    public function is_valid($eml, $uid, $pwd, $cls, $type): bool
    {

        $trimmed_uid = trim($uid);
        $trimmed_pwd = trim($pwd);
        $trimmed_eml = trim($eml);
        $trimmed_cls = trim($cls);

        if (empty($trimmed_uid) || empty($trimmed_pwd)) {

            $_SESSION["error"] = "EMPTY_INPUT";
            return false;

        }

        if ($type === "REGISTER") {

            if (empty($trimmed_eml) || empty($trimmed_cls)) {

                $_SESSION["error"] = "EMPTY_INPUT";
                return false;

            }

            if (!filter_var($eml, FILTER_VALIDATE_EMAIL)) {

                $_SESSION["error"] = "INVALID_EMAIL";
                return false;

            }

            $uppercase = preg_match('/[A-Z]/', $pwd);
            $lowercase = preg_match('/[a-z]/', $pwd);

            $decimal = preg_match('/[0-9]/', $pwd);
            $special = preg_match('/[^\w]/', $pwd);

            $length = strlen($trimmed_pwd) >= 8;

            if (!$length || !$uppercase || !$lowercase || !$decimal || !$special) {

                $_SESSION["error"] = "WEAK_PASSWORD";
                return false;

            }

        }

        return true;

    }

}