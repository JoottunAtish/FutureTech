<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FutureTech | Product review</title>

    <?php
    include "Essential_tags/Common_TAG.php";
    include_once "DB_CONNECTIONS/PDO_CONNECT.php";
    ?>

</head>

<body class="d-flex flex-column min-vh-100">

    <?php
        include "Menu/menu-list.php";
    ?>

    <h1 class="p-3">Leave a Review for the product</h1>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET"){
            $product_id = $_GET["pid"];

            $sql = "SELECT * FROM `products` WHERE ProductID = :pid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":pid", $product_id);
            $stmt->execute();

            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            if  (empty($product)){
                $err =  "Product not found";
                exit;
            } else {
                $pname = $product["ProductName"];
                $pimg = $product["imgPath"];
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $product_id = $_POST['pid'];
            $rating =  $_POST["rating"];
            $review  = $_POST["review"];
            $cid = $_SESSION['uid'];

            $sql = "INSERT INTO `reviews`(`CustomerID`, `ProductID`, `Rating`, `ReviewText`) VALUES (:cid, :pid, :rate, :reviewtext );";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(":cid", $cid);
            $stmt->bindParam(":pid", $product_id);
            $stmt->bindParam(":rate", $rating);
            $stmt->bindParam(":reviewtext", $review);

            if  ($stmt->execute()){
                $err = "Review submitted successfully";
            } else {
                $err = "Error submitting review";
            }
        }
    ?>
    
    <?php
        if (isset($err)){
            echo  "<script>alert('$err');window.location='account.php';</script>";
        }
    ?>

    <div class="d-flex gap-3 p-3 align-items-center">
        <img src="<?php echo $pimg; ?>" alt="Product Item" style="height: fit-content;" width="40%">
        <div class="d-flex gap-5 flex-column py-3">
            <h2><?php echo $pname; ?></h2>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"];  ?>" class="d-flex flex-column gap-3">
                <div class="d-flex gap-4 align-items-center">
                    <label for="rating">rating:</label>
                    <input required id="rating" name="rating" type="number" min=1 max=5 value=1>
                </div>

                <input style="display:none" type="text" name="pid" value="<?php echo $_GET['pid']?>">

                <div class="d-flex flex-column gap-2">
                    <label for="review">Enter Product Review</label>
                    <textarea required name="review" id="review" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary px-4" style="width:fit-content;">Submit</button>
            </form>
        </div>
    </div>

</body>

</html>