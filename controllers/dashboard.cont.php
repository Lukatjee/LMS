<?php

class DashboardController extends Dashboard
{

    private string $user_id;

    /**
     * Controller for the dashboard.
     * @param $user_id
     */

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * Show navigation button if user is an administrator.
     */

    public function display_admin()
    {
        if ($this->is_admin($this->user_id))
            print('<a href="../dashboard/admin/index.php">Admin</a>');
    }

}
