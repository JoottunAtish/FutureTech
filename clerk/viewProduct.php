<?php
include "DB_CONNECTIONS\PDO_ADMIN_CONNECT.php";
$sql = "SELECT * FROM products";

$stmt = $conn->prepare($sql);
$stmt->execute();
while ($row = $stmt->fetch()) {
    $id = $row['ProductID'];
    $name = $row['ProductName'];
    $price = $row['ProductPrice'];
    $desp = $row['Description'];
    $imgPath = $row['imgPath'];
    $cat = $row['Category'];

?>
    <div class="d-flex gap-4 p-3 m-2 border border-2 rounded">
        <div class="img-container">
            <img class="border border-1 rounded" style="max-width: 300px; max-height: 300px; overflow:hidden" src="<?php echo $imgPath; ?>">
        </div>
        <div class="d-flex flex-column justify-content-between">
            <div>
                <h3><?php echo $name; ?></h3>
                <p><?php echo $desp; ?></p>
                <h4>Rs. <?php echo number_format($price, 2, ".", ",");  ?></h4>
            </div>
            <div>
                <a href="clerk/modifyProduct.php?id=<?php echo $id; ?>">
                    <button class="btn btn-primary">Modify</button>
                </a>

                <a href="clerk/deleteProduct.php?id=<?php echo $id; ?>">
                    <button class="btn btn-primary">Delete</button>
                </a>
            </div>


        </div>
    </div>

<?php
}









?>