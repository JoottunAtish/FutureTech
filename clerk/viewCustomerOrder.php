<?php
require_once "DB_CONNECTIONS\PDO_ADMIN_CONNECT.php";

$sql = "SELECT * FROM `admin` WHERE AdminName = :name_admin AND Email = :mail";

$stm = $conn->prepare($sql);
$stm->bindparam(":name_admin", $_SESSION["username"]);
$stm->bindparam(":mail", $_SESSION["email"]);

$stm->execute();

if ($stm->rowCount() == 0) {
    echo "<script>alert('Restricted Access! Please Login.');window.location='login.php';</script>";
} else {

    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     $status = $_POST["status"];
    //     $cid = $_POST["cid"];
    //     $pid = $_POST["pid"];

    //     $sql = "UPDATE `bought_items` SET `Status`= :status WHERE `CustomerID` = :cid AND `ProductID` = :pid";
    //     $query = $conn->prepare($sql);
    //     $query->bindParam(":status", $status);
    //     $query->bindParam(":cid", $cid);
    //     $query->bindParam(":pid", $pid);

    //     $query->execute();
        
    // }


    $sql = "SELECT `CustomerID`, `CustomerName`, `CustomerEmail`,`ProductID`, `ProductName`, `Quantity`, `AddedDate`, `Status` FROM `bought_items_details_view` ORDER BY CustomerID, AddedDate ASC;";

    $query = $conn->prepare($sql);

    $query->execute();

    if ($query->rowCount() > 0) {
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $row) {
            $customers[$row["CustomerID"]][] = $row;
        }
    }

    // print_r($customers);
}
?>


<div class="p-3">
    <h2 class="display-5">View Customer Orders</h2>
    <div class="p-3 d-flex flex-column gap-3">
        <?php foreach ($customers as $customerID => $orders) :
            $customerName = $orders[0]['CustomerName'];
            $customerEmail = $orders[0]['CustomerEmail'];
        ?>
            <div class="customer-section border rounded p-3">
                <div class="customer-title"><strong>Customer</strong>: <?php echo $customerName; ?> (ID: <?php echo $customerID; ?>)</div>
                <div class="customer-info"><strong>Email:</strong> <?php echo $customerEmail; ?></div>
                <table class="product-table table">
                    <tr class="bg-secondary text-white">
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Added Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td><?php echo $order['ProductName']; ?></td>
                            <td><?php echo $order['Quantity']; ?></td>
                            <td><?php echo date('m/d/Y', strtotime($order['AddedDate'])); ?></td>
                            <td><?php echo $order['Status']; ?></td>
                            <td>
                                <button class="btn btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modifyModal"
                                    onclick="openModal(
                                        '<?php echo addslashes($order['ProductID']); ?>', 
                                        '<?php echo addslashes($order['ProductName']); ?>', 
                                        '<?php echo addslashes($order['CustomerID']); ?>', 
                                        '<?php echo addslashes($order['CustomerName']); ?>', 
                                        '<?php echo $order['Quantity']; ?>', 
                                        '<?php echo date('m/d/Y', strtotime($order['AddedDate'])); ?>', 
                                        '<?php echo $order['Status']; ?>'
                                    )">
                                    Modify
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="modifyModal" tabindex="-1" aria-labelledby="modifyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modifyModalLabel">Modify Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="./ValidationRoutes/val_Status.php" method="POST">
                <div class="modal-body d-flex flex-column gap-3">
                    <label for="customerid"><strong>Customer ID:</strong> <span id="modalcustomerID"></span></label>

                    <input type="hidden" id="customerid" name="cid">

                    <label for="Customername"><strong>Customer Name:</strong> <span id="modalCustomerName"></span></label>

                    <label for="productid"><strong>ProductID:</strong> <span id="modalProductId"></span></label>
                    <input type="hidden" id="productid" name="pid">

                    <label for="productname"><strong>Product Name:</strong> <span id="modalProductName"></span></label>
                    <label for="date"><strong>Product Name:</strong> <span id="modalAddedDate"></span></label>

                    <label for="status"><strong>Status:</strong></label>
                    <select name="status" id="status">
                        <option value="Pending">Pending</option>
                        <option value="Processing">Processing</option>
                        <option value="Closed">Closed</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- JavaScript to Populate Modal -->
<script>
    function openModal(productId, productName, customerId, customerName, quantity, addedDate, status) {
        console.log("Opening modal with:", productId, productName, customerId, customerName, quantity, addedDate, status); // Debugging

        // Set text content for display-only fields
        document.getElementById('modalcustomerID').innerHTML = customerId;
        document.getElementById('modalCustomerName').innerHTML = customerName;
        document.getElementById('modalProductId').innerHTML = productId;
        document.getElementById('modalProductName').innerHTML = productName;
        document.getElementById('modalAddedDate').innerHTML = addedDate;

        // Set hidden input fields for form submission
        document.getElementById('customerid').value = customerId;
        document.getElementById('productid').value = productId;

        // Set the status dropdown value
        document.getElementById('status').value = status;
    }
</script>