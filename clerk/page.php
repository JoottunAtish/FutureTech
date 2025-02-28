<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php
    include "../Essential_tags/Common_TAG.php";
    include_once("../DB_CONNECTIONS/PDO_ADMIN_CONNECT.php");
    include "../ValidationRoutes/val_add.php";

    $email = $_SESSION["email"];
    $username = $_SESSION["username"];

    $sql = "SELECT * FROM `admin` WHERE Email = :mail AND AdminName = :name";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':mail', $email);
    $stmt->bindParam(':name', $username);
    $stmt->execute();

    $rowcount = $stmt->rowCount();
    if ($rowcount == 0) {
        header("Location: ../homepage.php");
    }
    ?>
</head>

<body>

    <?php
    include "../Menu/admin-nav.php";
    ?>

    <nav class="m-3">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-viewProduct-tab" data-bs-toggle="tab" data-bs-target="#nav-viewProduct" type="button" role="tab" aria-controls="nav-profile" aria-selected="true">View Products</button>
            <button class="nav-link" id="nav-product-tab" data-bs-toggle="tab" data-bs-target="#nav-product" type="button" role="tab" aria-controls="nav-product" aria-selected="false">Add Product</button>
            <button class="nav-link" id="nav-viewCustomerOrder-tab" data-bs-toggle="tab" data-bs-target="#nav-viewCustomerOrder" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">View Orders</button>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active p-2 m-1" id="nav-viewProduct" role="tabpanel" aria-labelledby="nav-viewProduct-tab">
            <?php include "viewProduct.php" ?>
        </div>

        <div class="tab-pane fade" id="nav-product" role="tabpanel" aria-labelledby="nav-product-tab">
            <?php include "../Forms/admin-addProduct.php"; ?>
        </div>

        <div class="tab-pane fade" id="nav-viewCustomerOrder" role="tabpanel" aria-labelledby="nav-viewCustomerOrders-tab">
            <?php include "viewCustomerOrder.php" ?>
        </div>
    </div>

</body>

</html>