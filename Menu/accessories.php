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
        include "../Essential_tags/AJAX_TAG.php";
        include "../Essential_tags/Common_TAG.php";
     ?>

    <script src="JS\live-search.js" async></script>
    <title>FutureTech - Accessories</title>
</head>
<body>
    <?php
        include "menu-list.php";
    ?>

    <!-- Adding a search feature -->
    <div class="search-container">
        <input id='live-search' type="text" placeholder="Search...." >
        <!-- This will display the search results of the user's query -->
        <div class="search-dislay">
            <!-- Query will be added here -->
        </div>
    </div>

    <div class="card-container">
    </div>

</body>
</html>