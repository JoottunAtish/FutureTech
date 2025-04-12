<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futuretech | Manager Account</title>
</head>

<body>

    <?php
    include "../Essential_tags/Common_TAG.php";
    $account_link = "account.php";
    $homepage = "page.php";
    include "../Menu/admin-nav.php";
    ?>

    <div class="border rounded p-3" style="width: fit-content;">
        <div class="d-flex gap-2">
            <label for="">Name:</label>
            <p><?php echo $_SESSION["username"]; ?></p>
        </div>

        <div class="d-flex gap-2">
            <label for="">Email:</label>
            <p><?php echo $_SESSION["email"]; ?></p>
        </div>

        <a href="../logout.php" class="btn btn-primary">Sign Out</a>
    </div>

</body>

</html>