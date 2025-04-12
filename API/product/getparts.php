<?php
header('Content-Type:application/json');

include_once "../DBController.php";
include_once "../product.php";

$prod = new product();

$res = $prod->getParts();

echo json_encode($res);
?>