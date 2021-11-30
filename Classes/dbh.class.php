<?php

include dirname(__FILE__) .  "/../Services/Redirect.php";

class dbh
{

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
            redirect("index.php");

        }

        if ($stmt->rowCount() == 0) {

            $_SESSION['error'] = "UNKNOWN_USER";
            redirect("index.php");

        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

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