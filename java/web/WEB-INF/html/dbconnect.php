<?php

function connectToDB(){
        require 'dbconfig.php';
        $hostname = DB_HOST;
        $username = DB_USER;
        $password = DB_PASSWORD;
        $dbname = DB_DATABASE;

        try{
                $conn = new PDO(
                        "mysql:host=$hostname;dbname=$dbname", 
                        $username, 
                        $password
                );
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                return $conn;
        }
        catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
        }
}
?>