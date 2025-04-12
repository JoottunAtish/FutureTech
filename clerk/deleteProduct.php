<?php
include "..\DB_CONNECTIONS\PDO_ADMIN_CONNECT.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" & !empty($_GET)) {
    $sql = "SELECT * FROM `products` WHERE ProductID = " . $conn->quote($_GET['id']) . ";";
    $query = $conn->prepare($sql);
    $query->execute();

    if ($query->rowCount() > 0) {
        $result = $query->fetch(PDO::FETCH_ASSOC);

        $p_img = $result['imgPath'];
        $full_path = "..\\" . $p_img;
        echo $full_path;

        try {
            if (file_exists($full_path)) {
                echo "File exists: " . $full_path;
                unlink($full_path);
                echo "File deleted: " . $full_path;
            }
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }



    $sql = "DELETE FROM products WHERE ProductID = " . $conn->quote($_GET['id']) . ";";
    $query = $conn->prepare($sql);
    $query->execute();
    header("Location: page.php");
    exit();
} else {
    header("Location: page.php");
    exit();
}
