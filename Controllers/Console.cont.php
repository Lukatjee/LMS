<?php

include_once dirname(__FILE__) . "/../Classes/dbh.class.php";

class console_controller extends dbh
{

    private string $uid;

    public function __construct($uid)
    {

        $this->uid = $uid;

    }

    public function display_console()
    {

        if ($this->is_commander($this->uid)) {
            echo '<a href="../Commander/index.php">Commander</a><br>';
        }

    }

}
