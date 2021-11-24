<?php

class DBH
{

    /**
     * Connect to the database.
     * @return PDO|void
     */

    protected function connect()
    {

        $cred = parse_ini_file("../config.ini");

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
            header("location: ../index.php");

            exit();

        }

        if ($stmt->rowCount() == 0) {

            $_SESSION['error'] = "UNKNOWN_USER";
            header("location: ../index.php");

            exit();

        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}