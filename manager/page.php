<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futuretech - Manager page</title>
    <?php
    include "../DB_CONNECTIONS/PDO_ADMIN_CONNECT.php";
    include "../Essential_tags/Common_TAG.php";
    include "../ValidationRoutes/val_addAdmin.php";
    ?>
</head>

<body>
    <?php

    include "../Menu/admin-nav.php";

    ?>

    <nav class="m-3">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-admin-tab" data-bs-toggle="tab" data-bs-target="#nav-admin" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Create Admin</button>
            <button class="nav-link" id="nav-admin-list" data-bs-toggle="tab" data-bs-target="#nav-list-admin" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Admin List</button>
            <button class="nav-link" id="nav-viewCustomerOrder-tab" data-bs-toggle="tab" data-bs-target="#nav-viewCustomerOrder" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">View Orders</button>
            <button class="nav-link" id="nav-Report-tab" data-bs-toggle="tab" data-bs-target="#nav-reportview" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Report</button>
        </div>

    </nav>
    <!-- Tab panes -->
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane show active fade" id="nav-admin" role="tabpanel" aria-labelledby="nav-admin-tab">
            <?php include "../Forms/admin-addAdmin.php"; ?>
        </div>

        <div class="tab-pane fade" id="nav-list-admin" role="tabpanel" aria-labelledby="nav-admin-list">
            <?php include "list-admin.php"; ?>
        </div>

        <div class="tab-pane fade" id="nav-viewCustomerOrder" role="tabpanel" aria-labelledby="nav-viewCustomerOrders-tab">
            <?php include "../clerk/viewCustomerOrder.php" ?>
        </div>
        <div class="tab-pane fade" id="nav-reportview" role="tabpanel" aria-labelledby="nav-Report-tab">

        </div>
    </div>



</body>

</html>