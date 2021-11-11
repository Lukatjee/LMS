<?php

    class DBH {

        protected function connect() {

            try {

                $hostname = "49.12.205.241";
                $database = "lms";
                $username = "lms_admin";
                $password = "oAAXkgtQMOhF8Jo8ozs9Rn5LW2N4zWGfpJwJxbmHS7EpECOv";
                $charset = "utf8mb4";

                return new PDO("mysql:host=$hostname;dbname=$database;charset=$charset", $username, $password);
                
            } catch (PDOException $e) {

                print "Couldn't connect to database: " . $e->getMessage() . "<br>";
                die();

            }
            
        }
        
    }