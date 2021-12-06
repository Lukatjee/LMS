<?php

require __DIR__ . "/../Classes/dbh.class.php";

class console_controller extends dbh
{

    private string $uid;

    /**
     * Controller for the console page.
     * @param $uid
     */

    public function __construct($uid)
    {
        $this->uid = $uid;
    }

    /**
     * Returns true if the user is a commander.
     */

    public function get_is_commander()
    {
        $_SESSION['is_commander'] = $this->is_commander($this->uid);
    }

}
