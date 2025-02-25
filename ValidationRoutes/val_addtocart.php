<?php
include_once "..\DB_CONNECTIONS\PDO_ADMIN_CONNECT.php";
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pid = $_POST['pid'];
    $cid = $_POST['cid'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
}

$sql = "CALL insert_or_update_cart(" . $conn->quote($cid) . ", " . $conn->quote($pid) . ", " . $conn->quote($qty) . ", " . $conn->quote($price) . ")";

$query = $conn->prepare($sql);

if ($query->execute()) {
    $res = array(
        'status' => "success",
        'message' => 'Invalid Request',
    );
} else {
    $res = array(
        'status' => "error",
        'message' => 'Invalid Request',
    );
}

echo json_encode($res);

?>