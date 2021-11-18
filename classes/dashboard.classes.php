<?php

class Dashboard extends DBH
{

    public function getAdmin($user_id)
    {

        $stmt = $this->connect()->prepare('SELECT is_admin FROM users WHERE user_id=?;');

        if (!$stmt->execute([$user_id])) {

            $stmt = null;

            $_SESSION['error'] = "FAILED_CONNECTION";
            header("location: ../index.php");

            exit();

        }

        if ($stmt->rowCount() === 0) {

            $stmt = null;

            $_SESSION['error'] = "DASHBOARD_UNKNOWN_USER";
            header("location: ../index.php");

            exit();

        }

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res[0]["is_admin"];

    }

}