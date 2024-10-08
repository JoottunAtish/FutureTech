<?php
    $servername = "localhost";
    $username = "Kisto";
    $password = "123456789";
    $pdo_msg = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=futuretech", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        $pdo_msg = "Connection failed: Error connecting to database.";
    }

?>