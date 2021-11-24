<?php

class Dashboard extends DBH
{

    /**
     * Returns a boolean that indicates if the user is an administrator or not.
     * @param $user_id
     * @return bool
     */

    protected function is_admin($user_id): bool
    {

        $stmt = $this->connect()->prepare('SELECT is_admin FROM users WHERE user_id=?;');

        $res = $this->get_user($stmt, $user_id);

        return $res[0]["is_admin"] === 'true';

    }

}