<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        include_once("../DB_CONNECTIONS/PDO_ADMIN_CONNECT.php");
        $adminId = $_POST["adminId"];
        $adminName = $_POST["adminName"];
        $adminEmail = $_POST["adminEmail"];
        $adminRole = $_POST["adminRole"];
        $sql = "UPDATE `admin` SET AdminName = :adminName, Email = :adminEmail, AdminRole = :adminRole WHERE AdminID = :adminId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':adminId', $adminId);
        $stmt->bindParam(':adminName', $adminName);
        $stmt->bindParam(':adminEmail', $adminEmail);
        $stmt->bindParam(':adminRole', $adminRole);
        $stmt->execute();
        header("Location: page.php");
    }
?>