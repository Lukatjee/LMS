<?php

include_once dirname(__FILE__) . "/../Classes/dbh.class.php";

class commander_controller extends dbh
{

    private string $uid;

    public function __construct($uid)
    {
        $this->uid = $uid;
    }

    public function get_admin(): bool
    {
        return $this->is_commander($this->uid);
    }

}