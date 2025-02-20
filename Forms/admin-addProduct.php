<?php
    include "ValidationRoutes/val_add.php";
?>

<form class="p-3 m-4 col-10" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">

    <h3 class="display-4 m-4">Enter Product</h3>

    <!-- Product Name -->
    <div class="form-group m-4">
        <label for="pname">Product Name</label>
        <textarea class="form-control" name="pname" id="pname" placeholder="Enter product Name..." rows="2" required><?php echo $name; ?></textarea>
    </div>

    <!-- Product Description -->
    <div class="form-group m-4">
        <label for="pname">Product Description</label>
        <textarea class="form-control" name="pdesc" id="pdesc" placeholder="Enter product Description..." rows="4" style="height: 200px;" required><?php echo $desc;?></textarea>
    </div>


    <div class="container mt-5">
        <div class="row p-2 gap-4">
            <!-- Product Price -->
            <div class="form-group row col-12 col-md-6">
                <label for="pprice" class="col-4 col-form-label">Product Price</label>
                <div class="col input-group">
                    <div class="input-group-text">Rs</div>
                    <input class="form-control" type="text" name="pprice" id="pprice" placeholder="Enter Product Price..." required value="<?php echo $price; ?>">
                </div>
            </div>

            <!-- Product Discount -->
            <div class="form-group row col-12 col-md-6">
                <label for="pdiscount" class="col-4 col-form-label">Product discount</label>
                <div class="col input-group">
                    <input class="form-control" type="text" name="pdiscount" id="pdiscount" placeholder="Enter Product Discount(if any)..." value="<?php if (isset($discount)){echo $discount;} else {echo 0;} ?>">
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
                    <input class="form-control" type="text" name="pqty" id="pqty" placeholder="Enter Product Quantity..." required value="<?php echo $qty; ?>">
                </div>
            </div>

            <!-- Product Category-->
            <div class="form-group row col-12 col-md-6">
                <label for="pcat" class="col-4 col-form-label">Choose Category</label>
                <div class="col">
                    <select name="pcat" id="pcat" class="form-control" required value="<?php echo $cat; ?>">
                        <option>-- Select --</option>
                        <option value="1">PC-Parts</option>
                        <option value="2">Pre-Built PC</option>
                        <option value="3">PC Accessory</option>
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

    <button type="submit" class="btn btn-primary m-4">Submit</button>

</form>