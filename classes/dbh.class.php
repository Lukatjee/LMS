<?php

class DBH
{

    protected function connect()
    {

        $credentials = parse_ini_file("../config.ini");

        try {

            $hostname = $credentials["hostname"];
            $database = $credentials["database"];
            $username = $credentials["username"];
            $password = $credentials["password"];
            $charset = "utf8mb4";

            return new PDO("mysql:host=$hostname;dbname=$database;charset=$charset", $username, $password);

        } catch (PDOException $e) {

            print "Couldn't connect to database: " . $e->getMessage() . "<br>";
            die();

        }

    }

}