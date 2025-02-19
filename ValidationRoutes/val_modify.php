<?php
include "../DB_CONNECTIONS/PDO_ADMIN_CONNECT.php";

$imgPath = "";
$max_file_size = 6 * 1024 * 1024;  // 6MB

// The correct path to the 'Uploads/IMG' folder outside the current directory
$upload_folder = "../Uploads/IMG/";

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    // Receive the form data
    $id = $_POST['pid'];
    $name = $_POST['pname'];
    $price = $_POST['pprice'];
    $discount = $_POST['pdiscount'];
    $qty = $_POST['pqty'];
    $cat = $_POST['pcat'];
    $desc = $_POST['pdesc'];  // Assuming 'pdesc' is the correct field for the description.

    // Check if a file is uploaded
    $file = $_FILES['file-select'];
    $file_tmpname = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $file_type = $file['type'];

    // Debugging the $_FILES array
    print_r($_FILES);  // This will show the file information array
    
    // Ensure file is uploaded successfully
    if ($file_error !== 0) {
        $err_msg = "File upload error! Error code: " . $file_error;
    }

    // If no file uploaded, handle it without updating imgPath
    if (empty($file_tmpname) || !isset($file) || $file_error === 4) {
        // No file uploaded, retain current imgPath (no update for image)
        $sql = "UPDATE products SET ProductName = :name, ProductPrice = :price, Description = :desp, Category = :cat WHERE ProductID = :id";
    } else {
        // Check if the file extension is allowed
        $file_ext = explode('.', $file['name']);
        $file_actual_ext = strtolower(end($file_ext));
        $allow_type = ["png", 'jpg', 'jpeg'];
        
        if (in_array($file_actual_ext, $allow_type)) {
            if ($file_error === 0) {
                if ($file_size < $max_file_size) {  // Size check (6MB here)
                    // Check if the folder exists
                    if (!is_dir($upload_folder)) {
                        mkdir($upload_folder, 0777, true);  // Create the directory if it doesn't exist
                    }

                    // Move the uploaded file to the destination folder
                    $file_newname = $file['name'];  // New file name
                    $file_dest = $upload_folder . $file_newname;  // Full path to move the file

                    if (move_uploaded_file($file_tmpname, $file_dest)) {
                        // Proceed with updating the database with the new image path
                        $imgPath = $file_dest;  // Set the imgPath to the uploaded file path
                        $sql = "UPDATE products SET ProductName = :name, ProductPrice = :price, Description = :desp, imgPath = :imgPath, Category = :cat WHERE ProductID = :id";
                    } else {
                        $err_msg = "Error: Could not upload file!";
                    }
                } else {
                    $err_msg = "Error: File size too large. (Must be less than 6MB)";
                }
            } else {
                $err_msg = "Error: Could not upload file!";
            }
        } else {
            $err_msg = "Error: File type not allowed!";
        }
    }

    // Execute the SQL update query
    if (!isset($err_msg)) {
        // Prepare and execute the SQL statement
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':desp', $desc);
        $stmt->bindParam(':cat', $cat);
        $stmt->bindParam(':id', $id);

        if (isset($imgPath)) {
            $stmt->bindParam(':imgPath', $imgPath);  // Bind imgPath only if it's set
        }

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $success_msg = "Product updated successfully!";
            header("Location: ../adminpage.php");
            exit();  // Make sure to stop the script after redirecting
        } else {
            $upload_err = "Error: Could not update the product!";
        }
    }
}


?>
