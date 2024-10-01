<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FutureTech - Sign Up</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="signup.css">
</head>
<body class= "center-flex">
    <?php
        include "ValidationRoutes/val_signup.php";
    ?>
    
    <div class="container">
        <div class="shop-name">
            <h1>FutureTech</h1>
        </div>
        <p> <?php echo $pdo_msg ?></p>

        <div class="form-container">
            <form class="center-flex col-align gap-align" action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
                <input type="email" name="email" id="mail" placeholder="E-mail" value="<?php echo $_SESSION["email"] ?>" required>
                <input type="text" name="username" id="user" placeholder="User Name" value="<?php echo $_SESSION["username"] ?>" required>

                <!-- pattern = "'/^(?=.*[A-Z])(?=(?:[^A-Za-z0-9]*[^A-Za-z0-9]){2})(?=.*[0-9])(?=.{6,}).*$/'" title="The string must be at least 6 characters long. It must contain at least one uppercase letter (A-Z). There must be at least one numeric digit (0-9).  The string must include at least two special characters (e.g., !, @, #, $, etc.)." -->

                <input type="password" name="pass_1" id="passwd_1" pattern="^[a-zA-Z0-9\W]{6,}$" title="Password should be a minimum of 6 characters" placeholder="Password" required>
                <input type="password" name="pass_2" id="passwd_2" pattern="^[a-zA-Z0-9\W]{6,}$" title="Password should be a minimum of 6 characters" placeholder="Re-Enter Password" required>
                
                <p><?php echo $pwd_err ?></p>
                <button class="btn type"submit" name="login">Login</button>
            </form>
        </div>
    </div>

</body>
</html>