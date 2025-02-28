<?php
include "../DB_CONNECTIONS/PDO_ADMIN_CONNECT.php";

$sql = "SELECT * FROM `admin`";
$stmt = $conn->prepare($sql);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch()) {
?>
        <div class='card m-2 p-3 w-full'>
            <div class='card-body'>
                <h5 class='card-title fs-2'><?php echo $row['AdminName'] ?></h5>
                <h6 class='card-subtitle mb-2 text-muted'><span>Email: </span><?php echo $row['Email'] ?></h6>
                <p class='card-text fw-bold'><span>Admin role: </span><?php if ($row['AdminRole'] == 1) {
                                                    echo "Clerk";
                                                } else {
                                                    echo "Manager";
                                                }; ?></p>
                <a href='#' data-bs-toggle="modal" data-bs-target="#modifyModal" onclick="editAdmin(<?php echo $row['AdminID']; ?>, '<?php echo $row['AdminName'];  ?>', '<?php echo $row['Email'];  ?>', <?php echo $row['AdminRole'] ?>)" class='card-link btn btn-primary'>Edit</a>
                <a href='#' onclick="deleteAdmin(<?php echo $row['AdminID']; ?>)" class='card-link btn btn-danger'>Delete</a>
            </div>
        </div>
<?php
    }
}
?>

<div class="modal fade" id="modifyModal" tabindex="-1" aria-label="modifyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modifyModalLabel">Modify Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="modifyAdmin.php" method="post" id="modifyAdminForm">
                    <input type="hidden" id="adminId" name="adminId">
                    <div class="mb-3">
                        <label for="adminName" class="form-label">Admin Name</label>
                        <input type="text" class="form-control" id="adminName" name="adminName" required>
                    </div>
                    <div class="mb-3">
                        <label for="adminEmail" class="form-label">Admin Email</label>
                        <input type="email" class="form-control" id="adminEmail" name="adminEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="adminRole" class="form-label">Admin Role</label>
                        <select class="form-select" id="adminRole" name="adminRole" required>
                            <option value="1">Clerk</option>
                            <option value="2">Manager</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function deleteAdmin(adminId) {
        var result = confirm("Are you sure you want to delete this admin?");
        if (result) {
            fetch("deleteAdmin.php?adminId=" + adminId);
            location.reload();
        }
    }

    function editAdmin(adminId, adminName, adminEmail, adminRole) {
        document.getElementById('adminId').value = adminId;
        document.getElementById('adminName').value = adminName;
        document.getElementById('adminEmail').value = adminEmail;
        document.getElementById('adminRole').value = adminRole;
    }
</script>