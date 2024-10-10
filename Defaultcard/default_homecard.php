<!-- Hot deals section -->
<div class="m-5">
    <h1 class="display-2 p-2">Hot Deals</h1>

    <div class="container-fluid d-flex gap-4">
        <?php
        include "../product-search/DealSearch.php";
        ?>
    </div>
</div>


<div class="m-5">
    <h1 class="display-2 p-2">All Products</h1>

    <div class="container-fluid d-flex gap-4">

        <?php
        $limit = $_POST['input'];
        // limits the display search
        include "../product-search/GenericSearch.php";
        ?>

    </div>
</div>