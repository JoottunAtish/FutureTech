<?php
    session_start()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FutureTech - Sign Up</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="signup.css">

    <?php
    include "ValidationRoutes/val_signup.php";
    include "Essential_tags/Common_TAG.php";
    ?>

    <script src="JS\Passwd_toggle.js" async></script>
</head>

<body>

    <?php
    include "Forms/signup_form.php";
    ?>

</body>

</html>