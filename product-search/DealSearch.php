<?php
include "..\DB_CONNECTIONS\PDO_CONNECT.php";

$generic_sql = "SELECT * FROM `products` WHERE Discount >= 20;";

$g_query = $conn->prepare($generic_sql);
$g_query->execute();

// If deal exist
if ($g_query->rowCount() > 0) {
    $results = $g_query->fetchAll(PDO::FETCH_ASSOC);
    $count = 0;
    foreach ($results as $res) {
        // Limit display search
        if ($count == $limit){
            break;
        }
        $count++;

        $pid = $res['ProductID'];
        $p_name = $res['ProductName'];
        $p_des = $res["Description"];
        $p_price = $res['ProductPrice'];
        $p_img = $res['imgPath'];
        $p_discount = $res['Discount'];

?>
        <div class="card text-center mb-3" style="max-width: 300px;">
            <img src="<?php echo $p_img; ?>" alt="<?php echo $p_name; ?>" class="card-img img-responsive" style="max-width: 300px; max-height: 300px;">
            <div class="card-body">
                <h4 class="card-title text-truncate"><?php echo $p_name; ?></h4>
                <p class="card-text text-truncate"><?php echo $p_des; ?></p>
                <p><strike><?php echo "Rs. " . $p_price; ?></strike> <?php echo "Rs. " . $p_price * ((100 - $p_discount)/100); ?></p>
                <form action="../../FutureTech/productpage.php" method="POST">
                    <button name="pid" value="<?php echo $pid ?>" class="btn btn-primary">Go to page</button>
                </form>
            </div>
        </div>
<?php

    }
} else {
    echo '<p class="txt-danger display-6">Currently there are no deals</p>';
}
?>