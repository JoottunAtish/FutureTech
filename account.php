<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include "Essential_tags\Common_TAG.php";
    include "DB_CONNECTIONS/PDO_CONNECT.php";
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['username'] ?></title>
</head>

<body>

    <?php
    include "Menu/menu-list.php";
    ?>
    <div class="account-container p-3">

        <!-- Account details -->
        <div class="border rounded p-3" style="width: fit-content;">
            <div class="d-flex gap-2">
                <label for="">Name:</label>
                <p><?php echo $_SESSION["username"]; ?></p>
            </div>

            <div class="d-flex gap-2">
                <label for="">Email:</label>
                <p><?php echo $_SESSION["email"]; ?></p>
            </div>

            <a href="logout.php" class="btn btn-primary">Sign Out</a>
        </div>

        <!-- Items bought -->
        <div>
            <div>
                <h3 class="display-3 mt-5 fw-thin">Items Bought</h3>
                <div class="d-flex flex-column gap-2">
                    <?php
                    if (isset($_SESSION['uid'])) {
                        $sql = "SELECT * FROM bought_items_details_view WHERE CustomerID = " . $conn->quote($_SESSION['uid']) . ";";

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
                                $status = $res["Status"];

                                $sql_1 = "SELECT reviewID, ReviewText, Rating FROM reviews where productID = :pid AND customerID = :cid;";
                                $query = $conn->prepare($sql_1);
                                $query->bindParam(":pid", $pid);
                                $query->bindParam(":cid", $_SESSION['uid']);
                                $query->execute();
                                if ($query->rowCount() > 0) {
                                    $reviewExist = true;
                                    $reviewslist = $query->fetch(PDO::FETCH_ASSOC);
                                    $r_text = $reviewslist["ReviewText"];
                                    $r_rate = $reviewslist["Rating"];
                                } else {
                                    $reviewExist = false;
                                }
                    ?>
                                <div class="d-flex gap-2 border rounded p-3 flex-wrap">
                                    <img src="<?php echo $pimg ?>" alt="Product Item" style="width: 100%; max-width: 450px; height: fit-content;">
                                    <div class="px-3 w-full" style="width: auto;">
                                        <div class="d-flex flex-wrap gap-2 justify-content-between ">
                                            <h4 class="display-6 d-flex align-items-center gap-4"><?php echo $pname ?></h4>
                                            <span class=" bg-secondary text-white rounded p-3"><?php echo $status; ?></span>
                                        </div>
                                        <div>
                                            <p><?php echo  "Price: Rs. " . number_format($price, 2) ?></p>
                                            <p><?php echo "Quantity: " . $qty ?></p>
                                        </div>

                                        <div>
                                            <?php
                                            if ($reviewExist) {
                                            ?>
                                                <div class="border rounded p-3 mb-2">
                                                    <p><?php echo $r_text; ?></p>
                                                    <p><?php echo "rating: " . $r_rate . " / 5" ?></p>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="review.php?pid=<?php echo $pid; ?>" class="btn btn-secondary">Leave a review</a>
                                            <?php
                                            }
                                            ?>
                                        </div>

                                    </div>
                                </div>
                    <?php
                            }
                        }
                    }

                    ?>
                </div>
            </div>

        </div>

</body>

</html>