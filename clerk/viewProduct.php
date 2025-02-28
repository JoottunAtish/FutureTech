<?php

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
    $qty = $row['QtyInStock'];

    if ($cat == 1) {
        $cat = "PC Parts";
    } else if ($cat == 2) {
        $cat = "Pre-Built Desktops";
    } else if ($cat == 3) {
        $cat = "Accessories";
    }

?>
    <div class="d-flex gap-4 p-3 m-2 border border-2 rounded">
        <div class="img-container">
            <img class="border border-1 rounded" style="max-width: 300px; max-height: 300px; overflow:hidden" src="../../futuretech/<?php echo $imgPath; ?>">
        </div>
        <div class="d-flex flex-column justify-content-between">
            <div>
                <h3><?php echo $name; ?></h3>
                <p><?php echo $desp; ?></p>
                <h4>Rs. <?php echo number_format($price, 2, ".", ",");  ?></h4>
                <p><strong>Category:</strong> <?php echo $cat; ?></p>
                <p><strong>Quantity:</strong> <?php echo $qty; ?></p>
            </div>
            <div>
                <a href="modifyProduct.php?id=<?php echo $id; ?>">
                    <button class="btn btn-primary">Modify</button>
                </a>

                <a href="deleteProduct.php?id=<?php echo $id; ?>">
                    <button class="btn btn-primary">Delete</button>
                </a>
            </div>


        </div>
    </div>

<?php
}









?>