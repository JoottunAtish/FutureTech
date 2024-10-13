<?php
include("../DB_CONNECTIONS/PDO_CONNECT.php");

if (isset($_POST['input'])) {
    $user_in = trim($_POST['input']);

    $user_in = addslashes($user_in);

    $searchterms = explode(' ', $user_in);

    $query = "SELECT * FROM `products` WHERE ";
    $params[] = "";

    foreach ($searchterms as $term) {
        $placeholder = "term{$term}";
        $cond[] = "ProductName LIKE :{$placeholder} OR  Description LIKE :{$placeholder}";
        $params[$placeholder] = "%{$term}%";
    }

    if (count($cond) > 0) {
        $query .= implode(' OR ', $cond);
    } else {
        $query .= "1";
    }

    $res = $conn->prepare($query);
    $res->execute($params);
    $results = $res->fetchAll(PDO::FETCH_ASSOC);


    if ($res->rowCount() > 0) {
        foreach ($results as $result) {

            $pid = $result['ProductID'];
            $p_name = $result['ProductName'];
            $p_des = $result["Description"];
            $p_price = $result['ProductPrice'];
            $p_img = $result['imgPath'];
            $p_discount = $result['Discount'];

?>
            <div class="card text-center mb-3" style="max-width: 300px;">
                <img src="<?php echo "../../futuretech/" . $p_img; ?>" alt="<?php echo $p_name; ?>" class="card-img img-responsive" style="max-width: 300px; max-height: 300px; overflow:hidden">
                <div class="card-body">
                    <h4 class="card-title display-10 text-truncate"><?php echo $p_name; ?></h4>
                    <p class="card-text text-truncate"><?php echo $p_des; ?></p>
                    <p><?php include "price_display.php" ?></p>
                    <form action="../../FutureTech/productpage.php" method="POST">
                        <button name="pid" value="<?php echo $pid ?>" class="btn btn-primary">Go to page</button>
                    </form>
                </div>
            </div>

<?php
        }
    } else {
        echo "Nothing to display!";
    }
}
?>