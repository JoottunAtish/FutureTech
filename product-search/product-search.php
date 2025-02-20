<?php
include "DB_CONNECTIONS\PDO_CONNECT.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // if (isset($_SESSION["email"])) {
    //     $sql = "SELECT CustomerID FROM `customer` where Email = " . $conn->quote($_SESSION["email"]) . ";";
    //     $query = $conn->prepare($sql);
    //     $query->execute();
    //     if ($query->rowCount() > 0) {
    //         $result = $query->fetch(PDO::FETCH_ASSOC);
    //         $cid = $result["CustomerID"];
    //     }
    // }



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

?>

        <div class="container">
            <div class="row">
                <img class="col" src="<?php echo $full_path; ?>" alt="Product Image" style="max-width: 600px; height:auto;">

                <div class="col">
                    <h3 class="display-6"><?php echo $p_name; ?></h3>
                    <div class="row">
                        <span class="col-2">Price: </span>
                        <p class="col-3">Rs <?php echo $p_price; ?></p>
                    </div>

                    <div class="row">
                        <div class="row">
                            <span class="col-2">Quantity left: </span>
                            <p class="col-2"><?php echo $p_qty; ?></p>
                        </div>

                        <div class="d-flex align-items-center p-3">
                            <span>Enter Quantity</span>
                            <input type="number" id="qty" class="m-2 w-25" min="1" max="<?php echo $p_qty; ?>" value="1">
                        </div>
                    </div>

                    <?php
                    if (isset($_SESSION["email"]) && isset($_SESSION["username"])) {
                    ?>

                        <button id="cartBtn" class="btn btn-primary" onclick="addtocart()">Add to Cart</button>

                    <?php

                    } else {
                    ?>
                        <a href="futuretech/Login.php">
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
                <textarea readonly class="form-control" id="markdown" row="10" style="height:400px; resize: none;"><?php echo htmlentities(stripslashes($p_des), ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>
        </div>

<?php
    }
} else {
    header("Location: homepage.php");
    die();
}

?>

<script>
    function addtocart() {
        var productid = <?php echo $pid; ?>;
        var userid = <?php echo $_SESSION['uid']; ?>;
        var qty = document.getElementById("qty");
        var price = <?php echo $p_price; ?>;

        var res_send = {
            "pid": productid,
            "cid": userid,
            "qty": qty.value,
            "price": price
        };

        var formData = new FormData(); 

        
        formData.append("pid", productid);
        formData.append("cid", userid);
        formData.append("qty", qty.value);
        formData.append("price", price);

        
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