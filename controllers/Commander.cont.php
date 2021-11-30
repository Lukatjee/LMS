<?php

include dirname(__FILE__) . "/../Classes/dbh.class.php";

class commander_controller extends dbh {

    private $uid;

    public function __construct($uid) {

        $this->uid = $uid;

    }

    public function display_commander() {

        if ($this->is_admin($this->uid))
        {
            echo '<a href="../Commander/index.php">Admin</a>';
        }

    }

}
