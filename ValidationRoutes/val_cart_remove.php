<?php
session_start();
include_once "../DB_CONNECTIONS/PDO_CONNECT.php";

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $uid = $_SESSION['uid'];
    $pid = $_GET['pid'];

    $sql = "DELETE FROM `cart` WHERE CustomerID = " . $conn->quote($uid) . " AND ProductID = " . $conn->quote($pid) . ";";
    echo $sql;
    $query = $conn->prepare($sql);

    $query->execute();

    if ($query->rowCount() > 0){
        header("Location: ../cartpage.php");
    }


}

?>