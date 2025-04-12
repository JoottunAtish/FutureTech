<?php

include "DB_CONNECTIONS/PDO_CONNECT.php";

print_r($_SESSION);

if (!isset($_SESSION["email"])) {
    header("Location: homepage.php");
    die();
}

$sql = "SELECT * FROM `admin` WHERE Email = " . $conn->quote($_SESSION['email']) . ";";
print($sql);
$query = $conn->prepare($sql);
$query->execute();

if ($query->rowCount() > 0) {
    header("Location: adminpage.php");
    die();
} else {
    header("Location: homepage.php");
    die();
}

