<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    include "Essential_tags/AJAX_TAG.php";
    include "Essential_tags/Common_TAG.php";
    include_once("DB_CONNECTIONS/PDO_ADMIN_CONNECT.php");

    // Check if admin is loggged in.
    if (isset($_SESSION["email"]) && isset($_SESSION["username"])) {
        $email = $_SESSION["email"];
        $username = $_SESSION["username"];

        $sql = "SELECT `AdminRole` FROM `admin` WHERE Email = :mail AND AdminName = :name";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':mail', $email);
        $stmt->bindParam(':name', $username);
        $stmt->execute();

        $rowcount = $stmt->rowCount();
        $getRole = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($getRole) {
            $role = $getRole['AdminRole'];

            if ($role == 1) {
                header("Location: clerk/page.php");
                die();
            } else if ($role == 2) {
                header("Location: manager/page.php");
                die();
            }
        }
    }
    ?>
    <script src="JS/live-search.js" async></script>
    <title>FutureTech - Homepage</title>



</head>

<body>

    <?php
    include "Menu\menu-list.php";
    include "Forms\Search-function.php";
    // include "Defaultcard\default_homecard.php";
    ?>
    <!-- Display Default cards -->
    <div class="card-container m-4 live-search-default">
    </div>

</body>

</html>