<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FutureTech - Admin Page</title>
    <?php

    include "Essential_tags/AJAX_TAG.php";
    include "Essential_tags/Common_TAG.php";

    include "ValidationRoutes/val_admin.php";

    $err_msg = "";
    $success_msg = "";
    ?>

</head>

<body>
    <!-- <h1>ADMIN PAGE</h1>  -->

    <nav class="m-3">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-viewProduct-tab" data-bs-toggle="tab" data-bs-target="#nav-viewProduct" type="button" role="tab" aria-controls="nav-profile" aria-selected="true">View Products</button>
            <button class="nav-link" id="nav-product-tab" data-bs-toggle="tab" data-bs-target="#nav-product" type="button" role="tab" aria-controls="nav-product" aria-selected="false">Add Product</button>
            <button class="nav-link" id="nav-admin-tab" data-bs-toggle="tab" data-bs-target="#nav-admin" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Create Admin</button>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade" id="nav-product" role="tabpanel" aria-labelledby="nav-product-tab">
            <?php include "Forms/admin-addProduct.php"; ?>
        </div>
        <div class="tab-pane fade" id="nav-admin" role="tabpanel" aria-labelledby="nav-admin-tab">
            <?php include "Forms/admin-addAdmin.php"; ?>

        </div>
        <div class="tab-pane fade show active" id="nav-viewProduct" role="tabpanel" aria-labelledby="nav-viewProduct-tab">
            <?php include "clerk/viewProduct.php" ?>
        </div>
    </div>

</body>

</html>