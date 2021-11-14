<?php

class DBH
{

    protected function connect()
    {

        try {

            $hostname = "49.12.205.241";
            $database = "lms";
            $username = "lms_admin";
            $password = "";
            $charset = "utf8mb4";

            return new PDO("mysql:host=$hostname;dbname=$database;charset=$charset", $username, $password);

        } catch (PDOException $e) {

            print "Couldn't connect to database: " . $e->getMessage() . "<br>";
            die();

        }

    }

}