<?php
    session_start();

    include "DB_CONNECTIONS\PDO_CONNECT.php";

    $pwd_err = "";
    $_SESSION["username"] = "";
    $_SESSION["email"] = "";


    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $username = $_POST['username'];
        $pwd_1 = $_POST['pass_1'];
        $pwd_2 = $_POST['pass_2'];

        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;

        // Verify the passwords.
        if (!preg_match("/^[a-zA-Z0-9\W]{6,}$/", "123456")){
            $pwd_err = "Password is not secure enough. Please has atleast 6 characters!!";
        } else{

            if ($pwd_1 != $pwd_2){
                $pwd_err = "Passwords are not the same!";
            } else{
                $check_customer_sql = "SELECT * FROM customer WHERE Email = :mail AND UserName = :uname ;";
                $check_admin_sql = "SELECT * FROM customer WHERE Email = :mail AND AdminName = :uname ;";
                
                //Check for customer
                $customer_query = $conn->prepare($check_customer_sql);
                $customer_query->execute(array('mail'=> $email, 'uname' => $username));

                if ($customer_query->rowCount() >0){
                    $pwd_err = "User ". $username ."already exist. Please sign in.";
                } else {
                    
                }


            }
    
        }




        // Hash the password.
        $pwd_hash = password_hash($pwd_1, PASSWORD_DEFAULT);
        // First verify if the email and username exist in DB

        // DOES EXIST.
            // Display an error saying that the user already exist.
        
        // DOES NOT EXIST
            // Add the user to the DB and redirect to homepage.
    }



?>