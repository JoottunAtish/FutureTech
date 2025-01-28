<?php
include "..\DB_CONNECTIONS\PDO_ADMIN_CONNECT.php";
include "../Essential_tags/Common_TAG.php";


$upload_err = "";
$err_msg = "";
$success_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" & !empty($_GET)) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE ProductID = :id ;";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array('id' => $id));

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $name = $row['ProductName'];
        $price = $row['ProductPrice'];
        $desp = $row['Description'];
        $imgPath = $row['imgPath'];
        $cat = $row['Category'];
        $qty = $row['QtyInStock'];
        $discount = $row['Discount'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form class="p-3 m-4 col-10" action="../ValidationRoutes/val_modify.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="pid" value="<?php echo $id; ?>">
        <h3 class="display-4 m-4">Modify Product</h3>

        <!-- Product Name -->
        <div class="form-group m-4">
            <label for="pname">Product Name</label>
            <textarea value="<?php echo $name ?>" class="form-control" name="pname" id="pname" placeholder="Enter product Name..." rows="2" required><?php echo $name; ?></textarea>
        </div>

        <!-- Product Description -->
        <div class="form-group m-4">
            <label for="pname">Product Description</label>
            <textarea class="form-control" name="pdesc" id="pdesc" placeholder="Enter product Description..." rows="4" style="height: 200px;" required><?php echo $desp ?></textarea>
        </div>


        <div class="container mt-5">
            <div class="row p-2 gap-4">
                <!-- Product Price -->
                <div class="form-group row col-12 col-md-6">
                    <label for="pprice" class="col-4 col-form-label">Product Price</label>
                    <div class="col input-group">
                        <div class="input-group-text">Rs</div>
                        <input value="<?php echo $price ?>" class="form-control" type="text" name="pprice" id="pprice" placeholder="Enter Product Price..." required>
                    </div>
                </div>

                <!-- Product Discount -->
                <div class="form-group row col-12 col-md-6">
                    <label for="pdiscount" class="col-4 col-form-label">Product discount</label>
                    <div class="col input-group">
                        <input value="<?php echo $discount ?>" class="form-control" type="text" name="pdiscount" id="pdiscount" placeholder="Enter Product Discount(if any)...">
                        <div class="input-group-text">%</div>
                    </div>
                </div>

            </div>
        </div>



        <div class="container mt-5">
            <div class="row p-2">
                <!-- Product Discount -->
                <div class="form-group row col-12 col-md-6">
                    <label for="pqty" class="col-4 col-form-label">Product Quantity</label>
                    <div class="col">
                        <input value="<?php echo $qty; ?>" class="form-control" type="text" name="pqty" id="pqty" placeholder="Enter Product Quantity..." required>
                    </div>
                </div>

                <!-- Product Category-->
                <div class="form-group row col-12 col-md-6">
                    <label for="pcat" class="col-4 col-form-label">Choose Category</label>
                    <div class="col">
                        <select name="pcat" id="pcat" class="form-control" required>
                            <option>-- Select --</option>
                            <option value="1" <?php if ($cat == "1") echo "selected"; ?>>PC-Parts</option>
                            <option value="2" <?php if ($cat == "2") echo "selected"; ?>>Pre-Built PC</option>
                            <option value="3" <?php if ($cat == "3") echo "selected"; ?>>PC Accessory</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Image-->

        <div class="m-4">
            <label for="file" class="form-label">Choose file</label>
            <input
                type="file"
                class="form-control"
                name="file-select"
                id="file-select"
                placeholder="Choose a File..." />
            <div id="fileHelpId" class="form-text">Upload type: jpg, jpeg, png</div>
        </div>

        <p class="text-danger"> <?php echo $err_msg ?> </p>
        <p class="text-success"> <?php echo $success_msg ?> </p>

        <button type="submit" class="btn btn-primary m-4">Modify</button>

    </form>
</body>

</html>