<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo $_POST['pid'];
    } else{
        header("Location: homepage.php");
        die();
    }

?>