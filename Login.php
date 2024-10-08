<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FutureTech - Login</title>
    <script src="JS\Passwd_toggle.js" async></script>

    <?php
        include "Essential_tags/Common_TAG.php";
        include "ValidationRoutes\\val_login.php";
     ?>

</head>
<body>

    <div class="container min-vh-100 d-flex justify-content-center align-items-center">

        <div class="mb-3 col-4">
            <form class="row g-3" action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
                
                <div class="col-12 d-flex justify-content-center">
                    <h1 class="display-2">FutureTech</h1>
                </div>
                
                <div class="form-floating col-12">
                    <input class="form-control" type="email" name="username" id="user" placeholder="E-mail" required>
                    <label for="user">Email Address</label>
                </div>
                <!-- to auto fill add the value param in the input tag -->
                
                <div class="form-floating col-12">
                        <input class ="pwd form-control" type="password" name="pass" id="passwd" placeholder="Password" required>
                        <label for="passwd">Password</label>
                </div>
                
                <div class="form-switch form-check">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" onclick="togglepass()">
                    <label>Show password</label>
                </div>

                <P class="text-danger"><?php echo $usr_err?></P>

                <button class="btn btn-primary mb-3" type="submit" name="login">Login</button>

                <div class="d-flex justify-content-between">
                    <a class="" href="">forgot your password?</a>
                    <a class="" href="signup.php">Register an account</a>
                </div>
                
            </form>

        </div>
        

    </div>
    
</body>
</html>