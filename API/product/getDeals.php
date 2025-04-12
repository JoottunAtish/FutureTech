<?php
header('Content-Type:application/json');

include_once "../DBController.php";
include_once "../product.php";

if ($_SERVER["REQUEST_METHOD"] != "POST"){
    $out = array("success" => 0, "message" => "Invalid request method was used", "result" => []);
    echo json_encode($out);
    exit();
}

if (!empty($_POST["discount"])){
    $prod = new product();
    $res = $prod->getDeals($_POST["discount"]);
    echo json_encode($res);
    exit();
}

$out = array("success" => 0, "message" => "An unexpected error had occur", "result" => []);
echo json_encode($out);
exit();

?>