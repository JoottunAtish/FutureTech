<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FutureTech - Admin Page</title>
    <?php

        include "Essential_tags/AJAX_TAG.php";
        include "Essential_tags/Common_TAG.php";

        // include "ValidationRoutes/val_admin.php";

        $err_msg = "";
        $success_msg = "";

        // Can be removed!
        // include "ValidationRoutes/val_add.php";
    ?>

</head>
<body>
    <h1>ADMIN PAGE</h1> 

    <?php
    // include "Forms/admin-addAdmin.php";
    include "Forms/admin-addProduct.php";
    ?>
</body>
</html>