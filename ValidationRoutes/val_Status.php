<?php
include_once "../DB_CONNECTIONS/PDO_ADMIN_CONNECT.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST["status"];
    $cid = $_POST["cid"];
    $pid = $_POST["pid"];

    $sql = "UPDATE `bought_items` SET `Status`= :status WHERE `CustomerID` = :cid AND `ProductID` = :pid";
    $query = $conn->prepare($sql);
    $query->bindParam(":status", $status);
    $query->bindParam(":cid", $cid);
    $query->bindParam(":pid", $pid);

    $query->execute();
    header("Location: ../adminpage.php");
}

?>