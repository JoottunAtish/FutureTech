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

    <script src="JS\live-search.js" async></script>
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input id="live-search" type="text" class="form-control" placeholder="Search..." aria-label="Search">
                </div>
                <div id="search-display" class="list-group">
                    <!-- Query results will be displayed here -->
                </div>
            </div>
        </div>

    <div class="card-container">
    </div>

</body>
</html>