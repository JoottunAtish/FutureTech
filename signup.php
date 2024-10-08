<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FutureTech - Sign Up</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="signup.css">

    <script src="JS\Passwd_toggle.js" async></script>
</head>
<body class= "center-flex">
    <?php
        include "ValidationRoutes/val_signup.php";
        include "Essential_tags/Common_TAG.php";
    ?>
    
    <div class="container">

        <div class="container min-vh-100 d-flex justify-content-center align-items-center">
            <form class="" action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">

                <div class="">
                    <h1>FutureTech</h1>
                </div>
                <p> <?php echo $pdo_msg ?></p>

                <div>
                    <input type="email" name="email" id="mail" placeholder="E-mail" value="<?php echo $_SESSION["email"] ?>" required>
                </div>
                
                <div>
                    <input type="text" name="username" id="user" placeholder="User Name" value="<?php echo $_SESSION["username"] ?>" required>
                </div>
                
                <!-- pattern = "'/^(?=.*[A-Z])(?=(?:[^A-Za-z0-9]*[^A-Za-z0-9]){2})(?=.*[0-9])(?=.{6,}).*$/'" title="The string must be at least 6 characters long. It must contain at least one uppercase letter (A-Z). There must be at least one numeric digit (0-9).  The string must include at least two special characters (e.g., !, @, #, $, etc.)." -->
                
                <div>
                    <input class="pwd" type="password" name="pass_1" id="passwd_1" pattern="^[a-zA-Z0-9\W]{6,}$" title="Password should be a minimum of 6 characters" placeholder="Password" required>
                </div>
                
                <div>
                    <input class="pwd" type="password" name="pass_2" id="passwd_2" pattern="^[a-zA-Z0-9\W]{6,}$" title="Password should be a minimum of 6 characters" placeholder="Re-Enter Password" required>
                </div>

                <div class="form-switch form-check">
                    <input class="form-check-input" type="checkbox" name="" onclick="togglepass()">
                    <label>Show password</label>
                </div>
                
                <div>
                    <input type="text" name="phone" id="phone" placeholder="Phone Number" value="<?php echo $_SESSION["phone"] ?>">
                    <label for="phone">Phone Number</label>
                </div>
                
                <div>
                    <input type="text" name="country" id="country" placeholder="Country" value="<?php echo $_SESSION["country"] ?>">
                    <label for="country"></label>
                </div>
                
                <div>
                    <input type="text" name="city" id="city" placeholder="City" value="<?php echo $_SESSION["city"] ?>">
                    libxml_disable_entity_loader
                </div>
                
                <div>
                    <input type="text" name="postcode" id="postcode" placeholder="Postal code" value="<?php echo $_SESSION["postcode"] ?>">
                </div>

                <p><?php echo $pwd_err ?></p>
                <button class="" submit" name="login">Login</button>
            </form>
        </div>
    </div>
</body>
</html>