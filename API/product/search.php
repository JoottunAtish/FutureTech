<?php
header('Content-Type:application/json');

include_once "../DBController.php";
include_once "../product.php";


// Reject any other connnections apart from the POST METHOD
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $out = array("success" => 0, "message" => "Invalid request method was used", "result" => []);
    echo json_encode($out);
    exit();
}

// This checks if the keyword is not empty
if (!empty($_POST["keywords"])) {
    $prod = new product();
    $res = $prod->getSearchProduct($_POST["keywords"]);

    echo json_encode($res);
    // stop execution of the code here
    exit();
}

// This part is reached when the the keyword is empty.
$out = array("success" => 0, "message" => "Keywords cannot be empty", "result" => []);
echo json_encode($out);
exit();

?>
