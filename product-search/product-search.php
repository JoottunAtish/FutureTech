<?php
include "DB_CONNECTIONS\PDO_CONNECT.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['pid'])) {
    $sql = "SELECT * FROM `products` WHERE ProductID = " . $conn->quote($_GET['pid']) . ";";

    $query = $conn->prepare($sql);
    $query->execute();

    if ($query->rowCount() > 0) {
        $result = $query->fetch(PDO::FETCH_ASSOC);

        $pid = $result['ProductID'];
        $p_name = $result['ProductName'];
        $p_des = $result["Description"];
        $p_price = $result['ProductPrice'];
        $p_img = $result['imgPath'];
        $p_qty = $result['QtyInStock'];
        $full_path = "../../futuretech/" . $p_img;
        $p_discount = $result["Discount"];

?>

        <div class="container">
            <div class="d-flex flex-wrap justify-content-center">
                <img class="col p-3" src="<?php echo $full_path; ?>" alt="Product Image" style="max-width: 90vw; height:min-content;">

                <div class="col p-3">
                    <h3 class="display-6"><?php echo $p_name; ?></h3>
                    <div class="row">
                        <span class="col-2 p-1 px-3">Price: </span>
                        <div class="col-4 d-flex gap-2" style="width: fit-content;">
                            <?php
                            if ($p_discount > 0) {
                            ?><strike>
                                    <p class="p-1">
                                        <?php echo "Rs. " . number_format($p_price, 2, '.', ',') ?>
                                </strike>
                                </p>
                                <p class="bg-success text-white rounded p-1">
                                    <?php echo "Rs. " .  number_format($p_price * ((100 - $p_discount) / 100), 2, ".", ",");
                                    ?>
                                </p>

                            <?php
                            } else {
                                echo "Rs. " . number_format($p_price, 2, '.', ',');
                            }

                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex gap-3" style="width: max-content;">
                            <span class="col-2" style="width: fit-content;">Quantity left: </span>
                            <?php
                            if ($p_qty == 0) {
                            ?>
                                <p class="col-2 text-danger" style="width: fit-content;">Out of Stock</p>
                            <?php
                            } else {
                            ?>
                                <p class="col-2" style="width: fit-content;"><?php echo $p_qty; ?></p>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="d-flex align-items-center p-3">
                            <span>Enter Quantity</span>
                            <?php
                            if ($p_qty == 0) {
                            ?>
                                <input type="number" disabled id="qty" class="m-2 w-25 form-control" min="1" max="<?php echo $p_qty; ?>" value="1">
                            <?php
                            } else {
                            ?>
                                <input type="number" id="qty" class="m-2 w-25 form-control" min="1" max="<?php echo $p_qty; ?>" value="1">
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <?php
                    if (isset($_SESSION["email"]) && isset($_SESSION["username"])) {
                    ?>

                        <button id="cartBtn" class="btn btn-primary" onclick="addtocart()">Add to Cart</button>

                    <?php

                    } else {
                    ?>
                        <a href="Login.php">
                            <button class="btn btn-primary">Log In to purchase item</button>
                        </a>
                    <?php
                    }

                    ?>
                </div>

            </div>

        </div>

        <div class="container">
            <div class="p-4 form-group">
                <textarea readonly class="form-control" id="markdown" row="10" style="height:fit-content; resize: none;"><?php echo htmlentities(stripslashes($p_des), ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>

            <h3 class="display-6">Product Reviews</h3>
            <div class="m-3 p-2 d-flex flex-column gap-3 border rounded">
                <?php

                $sql = "SELECT * FROM reviews_with_customer_name WHERE ProductID = :pid";

                $statement = $conn->prepare($sql);
                $statement->bindParam(':pid', $_GET['pid']);
                $statement->execute();

                if ($statement->rowCount() > 0) {
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $res) {
                ?>
                        <div class="border rounded p-2 gap-3">
                            <div class="d-flex justify-content-between px-4 rounded bg-light align-items-center">
                                <div class="d-flex flex-column justify-content-start">
                                    <p class="h3"><?php echo $res['CustomerName']; ?></p>
                                    <p class="text-muted"><?php echo date('m/d/Y', strtotime($res['ReviewDate'])); ?></p>
                                </div>
                                <div>
                                    <p class="h2"><?php echo "Rating: " . $res["Rating"] . "/5" ?></p>
                                </div>
                            </div>

                            <div class="px-4">
                                <p class="h4 p-3"><?php echo $res["ReviewText"]; ?></p>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <p>No Review Available</p>
                <?php
                }
                ?>
            </div>
        </div>
<?php
    }
} else {
    echo "<script>alert('Page could not be loaded');window.location='homepage.php';</script>";
    die();
}
?>
<script>
    function addtocart() {
        var productid = <?php echo $pid; ?>;
        var userid = <?php echo $_SESSION['uid']; ?>;
        var qty = document.getElementById("qty");
        var price = <?php echo $p_price; ?>;
        var discount = <?php echo $p_discount; ?>;
        var final = price * ((100 - discount) / 100);

        var formData = new FormData();


        formData.append("pid", productid);
        formData.append("cid", userid);
        formData.append("qty", qty.value);
        formData.append("price", final);


        fetch(`ValidationRoutes/val_addtocart.php`, {
                method: "POST",
                body: formData,
            })
            .then(response => response.json())
            .then((data) => {
                if (data.status == "success") {
                    alert("Product added to cart");
                } else if (data.status == "error") {
                    alert("Error adding product to cart");
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });

    };
</script>