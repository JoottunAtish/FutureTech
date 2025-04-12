<?php

$upload_err = "";

$name = "";
$desc = "";
$price = "";
$discount = "";
$qty = "";
$cat = "";

// Image upload part
$file = "";
$file_tmpname = "";
$file_size = "";
$file_error = "";
$file_type = "";

$file_ext = "";
$file_actual_ext = "";

$allow_type = "";
$file_newname =
$file_dest = "";



if ($_SERVER['REQUEST_METHOD'] === 'POST' & isset($_POST['pname'])) {

    $name = filter_var($_POST['pname'], FILTER_SANITIZE_ADD_SLASHES);
    $desc = filter_var($_POST['pdesc'], FILTER_SANITIZE_ADD_SLASHES);
    $price = filter_var($_POST['pprice'], FILTER_SANITIZE_NUMBER_FLOAT);
    $discount = filter_var($_POST['pdiscount'], FILTER_SANITIZE_NUMBER_INT);
    $qty = filter_var($_POST['pqty'], FILTER_SANITIZE_NUMBER_INT);
    $cat = filter_var($_POST['pcat'], FILTER_SANITIZE_NUMBER_INT);

    // Image upload part
    $file = $_FILES['file-select'];
    $file_tmpname = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $file_type = $file['type'];

    $file_ext = explode('.', $file['name']);
    $file_actual_ext = strtolower(end($file_ext));

    $allow_type = ["png", 'jpg', 'jpeg'];
    $file_newname = $file['name'];
    $file_dest = "Uploads/IMG/" . $file_newname;


    if (empty($name) && empty($desc) && empty($price) && empty($cat)) {
        $upload_err = "Name, Description, Price and Category cannot be empty!!";
    } else {



        if (in_array($file_actual_ext, $allow_type)) {
            if ($file_error === 0) {
                if ($file_size < 1000000) {

                    if (!file_exists($file_dest)) {
                        move_uploaded_file($file_tmpname, "../" . $file_dest);

                        $insert_sql = "INSERT INTO `products`(`ProductName`, `Discount`, `ProductPrice`, `QtyInStock`, `Description`, `imgPath`, `Category`) VALUES
                            (" . $conn->quote($name) . "," . $conn->quote($discount) . "," . $conn->quote($price) . "," . $conn->quote($qty) . "," . $conn->quote($desc) . "," . $conn->quote($file_dest) . "," . $conn->quote($cat) . ");";


                        $insert_query = $conn->prepare($insert_sql);
                        $insert_query->execute();

                        if ($insert_query->rowCount() > 0) {
                            $success_msg = "File Uploaded!!";
                            // header("Location: adminpage.php");
                        } else {
                            unlink($file_dest);
                            $upload_err = "Error Could Not update database!!";
                        }
                    } else {
                        $err_msg = "Error: File Already exit";
                    }
                } else {
                    $err_msg = "Error: File size too large. (Less than 100MB).";
                }
            } else {
                $err_msg = "Error: Could not upload file!";
            }
        } else {
            $err_msg = "Error: File type not allowed!";
        }
    }
}
