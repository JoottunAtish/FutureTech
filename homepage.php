<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    include "Essential_tags/AJAX_TAG.php";
    include "Essential_tags/Common_TAG.php";
    ?>

    <script src="JS/live-search.js" async></script>

    <title>FutureTech - Homepage</title>
</head>

<body>
    <?php
    include "Menu\menu-list.php";
    ?>

    <!-- Adding a search feature -->
    <!-- Hero Section -->


    <?php include "Forms\Search-function.php" ?>


    <div class="card-container m-4 live-search-default">
    </div>

</body>

</html>