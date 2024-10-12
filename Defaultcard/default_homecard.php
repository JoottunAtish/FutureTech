<!-- Hot deals section -->
<div class="container">
    <h1 class="display-2 p-4 m-3 d-flex justify-content-center text-danger"><strong>&#128293;Hot Deals&#128293;</strong></h1>
    
    <div class="container-fluid d-flex gap-4 flex-wrap justify-content-center">
        <?php
        $limit = $_POST['deal'];
        include "../../futuretech/product-search/DealSearch.php";
        ?>
    </div>
</div>


<!-- All Product section -->
<div class="container">
    <h1 class="display-2 p-4 m-3 d-flex justify-content-center"><strong>All Products</strong></h1>
    <div class="row">
        <div class="container-fluid d-flex gap-4 flex-wrap justify-content-center">
            <?php
            $limit = $_POST['all'];
            // limits the display search
            include "../../futuretech/product-search/GenericSearch.php";
            ?>
        </div>
    </div>
</div>