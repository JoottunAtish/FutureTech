<?php
    //session_start();
?>

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
    include "ValidationRoutes/val_addAdmin.php";
    include "Essential_tags/Common_TAG.php";
    ?>


    <div class="container">
        <div class="mb-3 col-md-3">
            <form class="row g-3" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">

                <div class="col-12 d-flex justify-content-center">
                    <a href="homepage.php" class="display-2">FutureTech</a>
                </div>
                <p> <?php echo $pdo_msg ?></p>


                <div class="row-12 p-2">
                    <div class="form-floating col-12">
                        <input class="form-control" type="email" name="email" id="mail" placeholder="E-mail" value="<?php echo $_SESSION["email"] ?>" required>
                        <label for="mail">E-mail</label>
                    </div>

                    <div class="form-floating col-12">
                        <input class="form-control" type="text" name="adminname" id="adminname" placeholder="Admin Name" value="<?php echo $_SESSION["username"] ?>" required>
                        <label for="user">Admin Name</label>
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

                <div class="row-12 p-2">
                    <label for="role" class="col-form-label">Choose Admin level</label>
                    <div class="col">
                        <select name="role" id="role" class="form-control" required>
                            <option>-- Select --</option>
                            <option value="1">Clerk</option>
                            <option value="2">Manager</option>
                            <option value="3">Owner</option>
                        </select>
                    </div>
                </div>

                <p class="text-danger"><?php echo $pwd_err ?></p>

                <button class="btn btn-primary mb-3" type="submit" name="login">Sign-Up</button>
            </form>

        </div>

    </div>
</body>

</html>