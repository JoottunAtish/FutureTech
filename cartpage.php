<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FutureTech | Cart</title>

    <?php
    include "Essential_tags/Common_TAG.php";
    ?>

</head>

<body>

    <?php
    include "Menu\menu-list.php";
    include_once "DB_CONNECTIONS/PDO_CONNECT.php";


    $totalprice = 0;
    ?>

    <div class="p-4">
        <h2 class="display-4"><?php if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
                                    echo $_SESSION["username"];
                                } ?>'s Cart</h2>
        <div class="d-flex gap-4 p-3">

            <div>
                <?php
                $sql = "SELECT `ProductID`, `ProductName`, `Quantity`, `ProductImage`, `PriceAtCart`, `AddedDate`, `Discount` FROM `cart_details_view` where CustomerID = " . $conn->quote($_SESSION['uid']) . ";";

                $query = $conn->prepare($sql);
                $query->execute();
                if ($query->rowCount() > 0) {
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $res) {
                        $pname = $res["ProductName"];
                        $pid = $res["ProductID"];
                        $qty = $res["Quantity"];
                        $pimg  = $res["ProductImage"];
                        $price  = $res["PriceAtCart"];
                        $dateadded = $res["AddedDate"];
                        $discount = $res["Discount"];
                        $totalprice  +=  $qty * $price;

                ?>
                        <div style="max-width: 100%;" class="d-flex mb-3 p-2 border rounded">
                            <img src="<?php echo $pimg; ?>" class="p-3" style="max-width: 250px; height: fit-content;" alt="Product item">
                            <div>
                                <h4 class="display-6"><?php echo $pname; ?></h4>
                                <div>
                                    <p>Quantity: <span><?php echo $qty; ?></span></p>
                                    <p>Unit Price: <span><?php echo number_format($price, 2, ".", ","); ?></span></p>
                                    <p style="width: fit-content;" class="bg-secondary p-1 px-2 rounded text-white">Price: <span><?php echo number_format($price * $qty, 2, ".", ","); ?></span></p>
                                </div>
                                <div class="pb-2">
                                    <a href="ValidationRoutes/val_cart_remove.php?pid=<?php echo $pid;?>">
                                        <button class="btn btn-danger">Delete Item</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }

                ?>
            </div>
            <div style="width: 60%;  height: fit-content;" class="d-flex flex-column p-2 border rounded">
                <p class="display-6">Check-Out</p>
                <div class="px-4">
                    <p>Total Price: <span>Rs. <?php echo number_Format($totalprice, 2); ?></span></p>
                    <p>Tax: 15%</p>
                </div>
                <div class="px-5 d-flex justify-content-between gap-4">
                    <p class="bg-primary rounded text-white p-2 text-center">Final Price: Rs. <span><?php echo number_Format($totalprice* 1.15, 2); ?></span></p>
                    <a href="checkout.php">
                        <p href="" class="btn btn-success rounded text-white p-2 text-center">Check-Out</p>
                    </a>
                </div>
            </div>

        </div>
    </div>

</body>

</html>