<?php
include "../DB_CONNECTIONS/PDO_ADMIN_CONNECT.php";

$max_file_size = 6 * 1024 * 1024;  // 6MB
$upload_folder = "Uploads/IMG/";

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $id = $_POST['pid'];
    $name = $_POST['pname'];
    $price = $_POST['pprice'];
    $discount = $_POST['pdiscount'];
    $qty = $_POST['pqty'];
    $cat = $_POST['pcat'];
    $desc = $_POST['pdesc'];

    print_r($_FILES);

    $imgPath = "";

    // Check if a file is uploaded.
    if (isset($_FILES['file-select']) && $_FILES['file-select']['error'] !== 4) {
        $file = $_FILES['file-select'];
        $file_tmpname = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed_types = ["png", "jpg", "jpeg"];

        // Check for allowed files extension
        // Check for any error when uploading the file in the HTML
        // Check if file size does not exceed 6 MB.
        if (in_array($file_ext, $allowed_types) && $file_error === 0 && $file_size < $max_file_size) {
            if (!is_dir($upload_folder)) {
                mkdir($upload_folder, 0777, true);
            }
            // get the file name
            $file_newname = $file["name"];
            // Build the destination path
            $file_dest = "../" . $upload_folder . $file_newname;

            // if the file is successfully uploaded to server then update in db with image path.
            if (move_uploaded_file($file_tmpname, $file_dest)) {
                $imgPath = $upload_folder . $file_newname;
                $sql = "UPDATE products 
                        SET ProductName = :name, ProductPrice = :price, Description = :desp, imgPath = :imgPath, 
                            Category = :cat, QtyInStock = :qty 
                        WHERE ProductID = :id";
            } else {
                exit("Error: Could not upload file!");
            }
        } else {
            exit("Invalid file type or size too large!");
        }
    } else {
        $sql = "UPDATE products 
                SET ProductName = :name, ProductPrice = :price, Description = :desp, 
                    Category = :cat, QtyInStock = :qty 
                WHERE ProductID = :id";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':desp', $desc);
    $stmt->bindParam(':cat', $cat);
    $stmt->bindParam(':qty', $qty);
    $stmt->bindParam(':id', $id);
    
    if (isset($_FILES['file-select']) && $_FILES['file-select']['error'] !== 4) {
        echo "here";
        echo $imgPath;
        $stmt->bindParam(':imgPath', $imgPath);
    }

    if ($stmt->execute()) {
        header("Location: ../clerk/page.php");
        exit();
    } else {
        echo "Error: Could not update the product!";
    }
}
?>
