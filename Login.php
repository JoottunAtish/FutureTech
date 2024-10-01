<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FutureTech - Login</title>
    <link rel="stylesheet" href="style.css">
    <?php include "ValidationRoutes\\val_login.php" ?>
</head>
<body class= "center-flex">

    <div class="container center-flex  col-align">
        <div class="shop-name">
            <h1>FutureTech</h1>
        </div>

        <form class="center-flex col-align gap-align" action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
            <input type="text" name="username" id="user" placeholder="E-mail" required>
            <!-- to auto fill add the value param in the input tag -->
            
            <input type="password" name="pass" id="passwd" placeholder="Password" required>

            <P style="color: red;"><?php echo $usr_err?></P>

            <button class="btn type="submit" name="login">Login</button>
        </form>

        <div class="col-align">
            <a href="">forgot your password?</a>
            <a href="signup.php">Register an account</a>
        </div>
    </div>
    
</body>
</html>