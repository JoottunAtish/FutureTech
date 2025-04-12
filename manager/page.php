<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futuretech - Manager page</title>
    <?php

    include "../Essential_tags/Common_TAG.php";
    include_once("../DB_CONNECTIONS/PDO_ADMIN_CONNECT.php");

    $email = $_SESSION["email"];
    $username = $_SESSION["username"];
    $role = 2;

    $sql = "SELECT * FROM `admin` WHERE Email = :mail AND AdminName = :name AND AdminRole = :adminrole";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':mail', $email);
    $stmt->bindParam(':name', $username);
    $stmt->bindParam(':adminrole', $role);
    $stmt->execute();

    $rowcount = $stmt->rowCount();
    if ($rowcount == 0) {
        header("Location: ../homepage.php");
        die();
    }


    ?>
</head>

<body>
    <?php
    $account_link = "account.php";
    $homepage = "page.php";
    include "../Menu/admin-nav.php";

    ?>

    <nav class="m-3">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-admin-tab" data-bs-toggle="tab" data-bs-target="#nav-admin" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Create Admin</button>
            <button class="nav-link" id="nav-admin-list" data-bs-toggle="tab" data-bs-target="#nav-list-admin" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Admin List</button>
            <!-- <button class="nav-link" id="nav-viewCustomerOrder-tab" data-bs-toggle="tab" data-bs-target="#nav-viewCustomerOrder" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">View Orders</button> -->
            <button class="nav-link" id="nav-Report-tab" data-bs-toggle="tab" data-bs-target="#nav-reportview" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Report</button>
        </div>

    </nav>
    <!-- Tab panes -->
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane show active fade" id="nav-admin" role="tabpanel" aria-labelledby="nav-admin-tab">
            <?php
            $pwd_err = "";
            $pwd_toggle = "../JS/Passwd_toggle.js";
            include "../Forms/admin-addAdmin.php"; 
            ?>
        </div>

        <div class="tab-pane fade" id="nav-list-admin" role="tabpanel" aria-labelledby="nav-admin-list">
            <?php include "list-admin.php"; ?>
        </div>

        <!-- <div class="tab-pane fade" id="nav-viewCustomerOrder" role="tabpanel" aria-labelledby="nav-viewCustomerOrders-tab">
            <?php //include "../clerk/viewCustomerOrder.php" ?>
        </div> -->

        <div class="tab-pane fade" id="nav-reportview" role="tabpanel" aria-labelledby="nav-Report-tab">

        </div>
    </div>



</body>

</html>