<?php

class DashboardController extends Dashboard {

    private string $user_id;

    public function __construct($user_id)
    {

        $this->user_id = $user_id;

    }

    public function isAdmin(): bool
    {

        $isAdmin = $this->getAdmin($this->user_id);

        if ($isAdmin === 'true')
            echo '<a href="../dashboard/admin/index.php">Admin</a>';
        else
            return false;

        return false;

    }

}
