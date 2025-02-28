<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        include_once("../DB_CONNECTIONS/PDO_ADMIN_CONNECT.php");
        $adminId = $_GET["adminId"];
        $sql = "DELETE FROM `admin` WHERE AdminID = :adminId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':adminId', $adminId);
        $stmt->execute();
    }
?>