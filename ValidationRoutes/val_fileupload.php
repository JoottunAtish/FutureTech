<?php
    $err_msg = "";
    $success_msg = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
        
        if (in_array($file_actual_ext, $allow_type)){
            if ($file_error === 0) {
                if ($file_size < 1000000) {

                    if (!file_exists($file_dest)){
                        move_uploaded_file($file_tmpname, $file_dest);
                        $success_msg = "File Uploaded!!";
                    } else {
                    $err_msg = "Error: File Already exist";
                        
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
?>