<?php
session_start();
include "DB_CONNECTIONS/PDO_CONNECT.php";

if (!isset($_SESSION["email"])) {
    header("Location: homepage.php");
    die();
}

$sql = "SELECT`Email` FROM `admin` WHERE Email = " . $conn->quote($_SESSION['email']) . ";";

$query = $conn->prepare($sql);
$query->execute();

if ($query->rowCount() <= 0) {
    header("Location: homepage.php");
    die();
}
