<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FutureTech - Admin Page</title>
    <?php
        include "Essential_tags/AJAX_TAG.php";
        include "Essential_tags/Common_TAG.php";

        include "ValidationRoutes\\val_fileupload.php";
    ?>

</head>
<body>
    <h1>HOME PAGE</h1> 

    <form class="p-3" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="file" class="form-label">Choose file</label>
            <input
                type="file"
                class="form-control"
                name="file-select"
                id="file-select"
                placeholder="Choose a File..."
                
            />
            <div id="fileHelpId" class="form-text">Upload type: jpg, jpeg, png</div>
        </div>

        <p class="text-danger"> <?php echo $err_msg ?> </p>
        <p class="text-success"> <?php echo $success_msg ?> </p>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
</body>
</html>