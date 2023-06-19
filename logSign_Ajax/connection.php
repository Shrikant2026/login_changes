<?php
   
try{
    $dbHost = "localhost";
    $dbName = "db_login";
    $dbUser = "phpmyadmin";
    $dbPassword = "root";
        $myConn = new PDO("mysql:host=$dbHost;dbname=$dbName;",$dbUser,$dbPassword);
        $myConn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    // if ($myConn == true) {
    //     echo "success";
    // } else {
    //     echo "failure";
    // }
    
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>