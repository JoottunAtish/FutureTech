<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Menu\style-nav.css">

    <?php
    include "Essential_tags/AJAX_TAG.php";
    include "Essential_tags/Common_TAG.php";
    ?>

    <!-- <script src="JS\live-search.js" async></script> -->

    <title>FutureTech - Homepage</title>
</head>

<body>
    <?php
    include "Menu\menu-list.php";
    ?>

    <!-- Adding a search feature -->
    <!-- Hero Section -->
    <div class="container d-flex justify-content-center align-items-center">
        <div class="text-center">
            <h1>Welcome to FutureTech</h1>
            <p>Empowering the Future with Technology</p>
        </div>
    </div>


    <!-- Search Feature -->
    <!-- <div class="container">
        <div class="search-container input-group mb-3">
            <input id="live-search" type="text" class="form-control" placeholder="Search..." aria-label="Search">
        </div>
        <div class="search-display" class="list-group">
            <!-- Query results will be displayed here -->
    <!-- </div> -->
    <!-- </div> -->

    <?php include "Forms\Search-function.php" ?>

    <div class="card-container">

    </div>



</body>

</html>