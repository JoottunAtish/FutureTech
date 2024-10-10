<!-- Hot deals section -->
<div class="container">
    <h1 class="display-2 p-4 m-3 d-flex justify-content-center">Hot Deals</h1>

    <div class="container-fluid d-flex gap-4 flex-wrap justify-content-center">
        <?php
        $limit = $_POST['deal'];
        include "../product-search/DealSearch.php";
        ?>
    </div>
</div>


<div class="container">
    <h1 class="display-2 p-4 m-3 d-flex justify-content-center">All Products</h1>
    <div class="row">
        <div class="container-fluid d-flex gap-4 flex-wrap justify-content-center">
            <?php
            $limit = $_POST['all'];
            // limits the display search
            include "../product-search/GenericSearch.php";
            ?>
        </div>
    </div>
</div>