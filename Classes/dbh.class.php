<?php

class dbh
{

    /**
     * Returns a boolean that indicates if the user is an administrator or not.
     * @param $user_id
     * @return bool
     */

    protected function is_commander($user_id): bool
    {

        $stmt = $this->connect()->prepare('SELECT is_admin FROM users WHERE user_id=?;');

        $res = $this->get_user($stmt, $user_id);

        return $res[0]["is_admin"] === 'true';

    }

    /**
     * Connect to the database.
     * @return PDO|void
     */

    protected function connect()
    {

        $cred = parse_ini_file(dirname(__FILE__) . "/../config.ini");

        try {

            $hostname = $cred["hostname"];
            $database = $cred["database"];
            $username = $cred["username"];
            $password = $cred["password"];
            $charset = "utf8mb4";

            return new PDO("mysql:host=$hostname;dbname=$database;charset=$charset", $username, $password);

        } catch (PDOException $e) {

            print "Couldn't connect to the database: " . $e->getMessage() . "<br>";
            die();

        }

    }

    /**
     * Fetch credentials from the user table.
     * @param $stmt
     * @param $uid
     * @return array
     */

    protected function get_user($stmt, $uid): array
    {

        if (!$stmt->execute([$uid])) {

            $_SESSION['error'] = "FAILED_CONNECTION";
            redirect("index.php", true);

        }

        if ($stmt->rowCount() == 0) {

            $_SESSION['error'] = "UNKNOWN_USER";
            redirect("index.php", true);

        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    protected function exists($stmt, $uid): bool
    {

        if (!$stmt->execute([$uid])) {

            $_SESSION['error'] = "FAILED_CONNECTION";
            redirect("index.php", true);

        }

        if ($stmt->rowCount() == 0) {

            return false;

        }

        return true;

    }

    protected function add_user($stmt, $uid, $pwd, $cmd)
    {

        if (!$stmt->execute([$uid, $pwd, $cmd])) {

            $_SESSION['error'] = "FAILED_CONNECTION";
            redirect("index.php", true);

        }

        $_SESSION['error'] = "CREATED_USER";

    }

}