<?php
include "DB_CONNECTIONS\PDO_CONNECT.php";

$generic_sql = "SELECT * FROM `products` ;";

$g_query = $conn->prepare($generic_sql);
$g_query->execute();

if ($g_query->rowCount() > 0) {
    $results = $g_query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $res) {
        $pid = $res['ProductID'];
        $p_name = $res['ProductName'];
        $p_des = $res["Description"];
        $p_price = $res['ProductPrice'];
        $p_img = $res['imgPath'];

?>
        <div class="card text-center mb-3" style="max-width: 450jpx;">
            <img src="<?php echo $p_img; ?>" alt="<?php echo $p_name; ?>" class="card-img">
            <div class="card-body">
                <h4 class="card-title"><?php echo $p_name; ?></h4>
                <p class="card-text text-truncate"><?php echo $p_des; ?></p>
                <p><?php echo "Rs. " . $p_price; ?></p>
                <button class="btn btn-primary">Go to page</button>
            </div>
        </div>

<?php

    }
} else {
    echo '<p class="txt-danger">Currently there are no deals</p>';
}
?>