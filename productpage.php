<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    include "Essential_tags/AJAX_TAG.php";
    include "Essential_tags/Common_TAG.php";
    ?>
    <title>FutureTech -- Product Page</title>
    <script src="JS/live-search.js" async></script>
</head>

<body>


    <?php
    include "Menu\menu-list.php";
    include "Forms\Search-function.php";
    ?>
    <div class="container p-4">
        <a href="homepage.php" class="p-2 btn btn-primary">Homepage</a>

    </div>
    <?php
    include "product-search/product-search.php";
    ?>
</body>

</html>