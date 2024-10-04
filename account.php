<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $_SESSION['username'] ?></title>
</head>
<body>
    <div class="account-container">

        <label for="">Name:</label>
        <p><?php echo $_SESSION["username"]; ?></p>

        <label for="">Email:</label>
        <p><?php echo $_SESSION["email"]; ?></p>

    </div>

    <a href="logout.php">Sign Out</a>
</body>
</html>