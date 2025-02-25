<?php
    if (!isset($_SESSION['email'])) {
        $_SESSION['email'] = "";
    }

?>
<div class="container min-vh-100 d-flex justify-content-center align-items-center">

<div class="mb-3 col-md-3">
    <form class="row g-3" action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
        
        <div class="col-12 d-flex justify-content-center">
            <a href="homepage.php" class="display-2">FutureTech</a>
        </div>
        
        <div class="form-floating col-12">
            <input class="form-control" type="email" name="email" id="user" placeholder="E-mail" value="<?php echo $_SESSION['email'] ?>" required>
            <label for="user">Email Address</label>
        </div>
        <!-- to auto fill add the value param in the input tag -->
        
        <div class="form-floating col-12">
                <input class ="pwd form-control" type="password" name="pass" id="passwd" placeholder="Password" required>
                <label for="passwd">Password</label>
        </div>
        
        <div class="form-switch form-check m-2">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" onclick="togglepass()">
            <label>Show password</label>
        </div>

        <P class="text-danger"><?php echo $usr_err?></P>

        <button class="btn btn-primary mb-3" type="submit" name="login">Login</button>

        <div class="d-flex justify-content-between">
            <a href="#">forgot your password?</a>
            <a href="signup.php">Register an account</a>
        </div>
        
    </form>
</div>
</div>