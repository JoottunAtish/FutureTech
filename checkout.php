<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php
    include "Essential_tags/Common_TAG.php";
    include_once "DB_CONNECTIONS/PDO_CONNECT.php";
    ?>

</head>

<body>
    <h1>Checkout page</h1>

    <?php
        $sql = "CALL purchase_cart(" . $conn->quote($_SESSION['uid']) .");";

        $query = $conn->prepare($sql);

        $query->execute();

        if ($query->rowCount() > 0){
            echo "<script>alert('Purchase successful');window.location='account.php';</script>";
        }
    ?>

</body>

</html>