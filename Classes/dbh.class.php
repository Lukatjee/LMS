<?php

use JetBrains\PhpStorm\NoReturn;

class dbh
{

    /**
     * Check if a user id already exists.
     * @param $stmt
     * @param $uid
     * @param $eml
     * @return bool
     */

    protected function exists($stmt, $uid, $eml): bool
    {

        if (!$stmt->execute([$uid, $eml])) {

            $_SESSION['error'] = "FAILED_CONNECTION";
            redirect("index.php", true);

        }

        if ($stmt->rowCount() == 0)
            return false;

        return true;

    }

    /**
     * Returns a boolean that indicates if the user is an administrator or not.
     * @param $user_id
     * @return bool
     */

    protected function is_commander($user_id): bool
    {

        $stmt = $this->connect()->prepare('SELECT is_admin FROM users WHERE user_id=?;');

        $res = $this->get_user($stmt, $user_id);

        return $res[0]["is_admin"] === 1;

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

    /**
     * Fetch all users from the database.
     * @param $stmt
     * @return array
     */

    protected function get_users($stmt): array
    {

        if (!$stmt->execute()) {

            $_SESSION['error'] = "FAILED_CONNECTION";
            redirect("index.php", true);

        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Insert data into the database to create a new user.
     * @param $stmt
     * @param $eml
     * @param $uid
     * @param $pwd
     * @param $role
     * @param $cls
     */

    #[NoReturn] protected function create_user($stmt, $eml, $uid, $pwd, $role, $cls)
    {

        try {

            $stmt->execute([$eml, $uid, $pwd, $role, $cls]);

            redirect("Templates/Commander/Users/_fetchusers.php", false);

        } catch (PDOException $exception) {

            $_SESSION['error'] = $exception->getMessage();

        }

    }

}