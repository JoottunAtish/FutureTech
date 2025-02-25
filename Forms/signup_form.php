<div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="mb-3 col-md-3">
            <form class="row g-3" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">

                <div class="col-12 d-flex justify-content-center">
                    <a href="homepage.php" class="display-2">FutureTech</a>
                </div>
                <p> <?php echo $pdo_msg ?></p>


                <div class="row-12 p-2">
                    <div class="form-floating col-12">
                        <input class="form-control" type="email" name="email" id="mail" placeholder="E-mail"  required>
                        <label for="mail">E-mail</label>
                    </div>

                    <div class="form-floating col-12">
                        <input class="form-control" type="text" name="username" id="user" placeholder="User Name"  required>
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
                        <input class="form-control" type="text" name="phone" id="phone" placeholder="Phone Number">
                        <label for="phone">Phone Number</label>
                    </div>

                    <div class="form-floating col-12">
                        <input class="form-control" type="text" name="country" id="country" placeholder="Country">
                        <label for="country">Enter Country</label>
                    </div>
                </div>


                <div class="row-12 p-2">
                    <div class="col form-floating">
                        <input class="form-control" type="text" name="city" id="city" placeholder="City">
                        <label for="city">Enter City</label>
                    </div>

                    <div class="col form-floating">
                        <input class="form-control" type="text" name="postcode" id="postcode" placeholder="Postal code">
                        <label for="postcode">Enter Postal Code</label>
                    </div>

                </div>
                
                <div class="px-3">
                    <a href="Login.php">Already have an account?</a>
                </div>

                <p><?php echo $pwd_err ?></p>

                <button class="btn btn-primary mb-3" type="submit" name="login">Sign-Up</button>
            </form>

        </div>
    </div>