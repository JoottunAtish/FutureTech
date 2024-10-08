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
<body>
    <?php
        include "ValidationRoutes/val_signup.php";
        include "Essential_tags/Common_TAG.php";
    ?>
    
    
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
            <div class="mb-3 col-4">
                <form class="row g-3" action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">

                    <div class="col-12 d-flex justify-content-center">
                        <h1 class="display-2">FutureTech</h1>
                    </div>
                    <p> <?php echo $pdo_msg ?></p>

                    
                    <div class="row-12 p-2">
                        <div class="form-floating col-12">
                            <input class="form-control" type="email" name="email" id="mail" placeholder="E-mail" value="<?php echo $_SESSION["email"] ?>" required>
                            <label for="mail">E-mail</label>
                        </div>
                        
                        <div class="form-floating col-12">
                            <input class="form-control" type="text" name="username" id="user" placeholder="User Name" value="<?php echo $_SESSION["username"] ?>" required>
                            <label for="user">User Name</label>
                        </div>
                    </div>
                    

                    <div class="row-12 p-2">
                        <div class="form-floating col-12">
                            <input class="pwd form-control" type="password" name="pass_1" id="passwd_1" pattern="^[a-zA-Z0-9\W]{6,}$" title="Password should be a minimum of 6 characters" placeholder="Password" required>
                            <label for="passwd_1">Enter Password</label>
                        </div>
                        
                        <div class="form-floating col-12">
                            <input class="pwd form-control" type="password" name="pass_2" id="passwd_2" pattern="^[a-zA-Z0-9\W]{6,}$" title="Password should be a minimum of 6 characters" placeholder="Re-Enter Password" required>
                            <label for="passwd_2">Re-Enter Password</label>
                        </div>

                    </div>
                    
                    <div class="form-switch form-check row-12 m-2">
                        <input class="form-check-input" type="checkbox" name="" onclick="togglepass()">
                        <label>Show Password</label>
                    </div>

                    <div class="row-12">
                        <div class="form-floating col-12">
                            <input class="form-control" type="text" name="phone" id="phone" placeholder="Phone Number" value="<?php echo $_SESSION["phone"] ?>">
                            <label for="phone">Phone Number</label>
                        </div>
                        
                        <div class="form-floating col-12">
                            <input class="form-control" type="text" name="country" id="country" placeholder="Country" value="<?php echo $_SESSION["country"] ?>">
                            <label for="country">Enter Country</label>
                        </div>
                    </div>
                    
                    
                    <div class="row-12 p-2">
                        <div class="col form-floating">
                            <input class="form-control" type="text" name="city" id="city" placeholder="City" value="<?php echo $_SESSION["city"] ?>">
                            <label for="city">Enter City</label>
                        </div>
                        
                        <div class="col form-floating">
                            <input class="form-control" type="text" name="postcode" id="postcode" placeholder="Postal code" value="<?php echo $_SESSION["postcode"] ?>">
                            <label for="postcode">Enter Postal Code</label>
                        </div>
                    </div>

                    
                    <p><?php echo $pwd_err ?></p>

                    <button class="btn btn-primary mb-3" type="submit" name="login">Sign-Up</button>
                </form>

            </div>

    </div>
</body>
</html>