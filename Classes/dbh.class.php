<?php

class dbh
{

    protected function connect()
    {

        $cred = parse_ini_file(dirname(__FILE__) . "/../config.ini");

        try {

            return new PDO("mysql:host=" . $cred["hostname"] . ";dbname=" . $cred["database"] . ";charset=utf8mb4", $cred["username"], $cred["password"]);

        } catch (PDOException $e) {

            echo "Couldn't connect to the database: " . $e->getMessage() . "<br>";
            die();

        }

    }

    protected function exists($stmt, $uid, $eml) : bool
    {

        try {

            $stmt->execute([$uid, $eml]);

        } catch (PDOException $e) {

            echo "Couldn't execute statement: " . $e->getMessage() . "<br>";

        }

        if ($stmt->rowCount() == 0)
            return false;

        return true;

    }

    protected function getUser($stmt, $uid) : array
    {

        try {

            $stmt->execute([$uid]);

        } catch (PDOException $e) {

            echo "Couldn't execute statement: " . $e->getMessage() . "<br>";

        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    protected function getUsers($stmt) : array
    {

        try {

            $stmt->execute();

        } catch (PDOException $e) {

            echo "Couldn't execute statement: " . $e->getMessage() . "<br>";

        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    protected function createUser($stmt, $eml, $uid, $pwd)
    {

        try {

            $stmt->execute([$eml, $uid, $pwd]);

        } catch (PDOException $e) {

            echo "Couldn't execute statement: " . $e->getMessage() . "<br>";

        }

        redirect("Templates/Commander/Users/_fetchusers.php", false);

    }

}