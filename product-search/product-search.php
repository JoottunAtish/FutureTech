<?php
include "DB_CONNECTIONS/PDO_CONNECT.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "SELECT * FROM `products` WHERE ProductID = " . $conn->quote($_POST['pid']) . ";";

    $query = $conn->prepare($sql);
    $query->execute();

    if ($query->rowCount() > 0) {
        $result = $query->fetch(PDO::FETCH_ASSOC);

        $pid = $result['ProductID'];
        $p_name = $result['ProductName'];
        $p_des = $result["Description"];
        $p_price = $result['ProductPrice'];
        $p_img = filter_var($result['imgPath'], FILTER_SANITIZE_URL);
        $p_qty = $result['QtyInStock'];
        $full_path = "../../futuretech/" . $p_img;

?>

        <div class="container">
            <div class="row">
                <img class="col" src=<?php echo $full_path; ?> alt="keyboard" style="max-width: 600px;">

                <div class="col">
                    <h3 class="display-6"><?php echo $p_name; ?></h3>
                    <div class="row">
                        <span class="col-2">Price: </span>
                        <p class="col-3">Rs <?php echo $p_price; ?></p>
                    </div>

                    <div class="row">
                        <div class="row">
                            <span class="col-2">Quantity left: </span>
                            <p class="col-2"><?php echo $p_qty; ?></p>
                        </div>
    
                        <div class="row">
                            <span class="col-2">Amount: </span>
                            <p class="col-3">XX Amount</p>
                        </div>
                    </div>

                    <button class="btn btn-primary">Add to Cart</button>
                </div>

            </div>

        </div>
        
        <div class="container">
            <div class="p-4 form-group">
                <textarea readonly class="form-control" id="markdown" row="10" style="height:400px; resize: none;"><?php echo htmlentities(stripslashes($p_des), ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>
        </div>

<?php
    }
} else {
    header("Location: homepage.php");
    die();
}

?>