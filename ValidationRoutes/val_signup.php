<?php
    session_start();

    include "DB_CONNECTIONS\PDO_CONNECT.php";

    $pwd_err = "";
    if (!(isset($_SESSION["username"]) || isset($_SESSION["email"]))){
        $_SESSION["username"] = "";
        $_SESSION["email"] = "";
        $_SESSION["username"] = "";
        $_SESSION["email"] = "";
        $_SESSION["country"] = "";
        $_SESSION["city"] = "";
        $_SESSION["postcode"] = "";
        $_SESSION['phone'] = "";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $username = $_POST['username'];

        $pwd_1 = $_POST['pass_1'];
        $pwd_2 = $_POST['pass_2'];

        $country = $_POST['country'];
        $city = $_POST['city'];
        $postcode = $_POST['postcode'];
        $phone = $_POST['phone'];

        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
        $_SESSION["country"] = $country;
        $_SESSION["city"] = $city;
        $_SESSION["postcode"] = $postcode;
        $_SESSION["phone"] = $phone;

        // Verify the passwords.
        if (!preg_match("/^[a-zA-Z0-9\W]{6,}$/", "123456")){
            $pwd_err = "Password is not secure enough. Please has atleast 6 characters!!";
        } else{

            if ($pwd_1 != $pwd_2){
                $pwd_err = "Passwords are not the same!";
            } else{
                $check_customer_sql = "SELECT * FROM customer WHERE Email = :mail ;";
                $check_admin_sql = "SELECT * FROM admin WHERE Email = :mail ;";

                // Check for admin:
                $admin_query = $conn->prepare($check_admin_sql);
                $admin_query->execute(array('mail'=>$email));

                if ($admin_query->rowCount() > 0){
                    $pwd_err = "Admins should Log-in!";
                } else{
                    //Check for customer
                    $customer_query = $conn->prepare($check_customer_sql);
                    $customer_query->execute(array('mail'=> $email));
    
                    if ($customer_query->rowCount() > 0){
                        $pwd_err = "This `". $email ."` email already exist. Please log-in.";
                    } else {
                        $pwd_hash = password_hash($pwd_1, PASSWORD_DEFAULT);
                        $insert_customer = "INSERT INTO `customer`(`UserName`, `Email`, `Password`, `Country`, `City`, `PostalCode`, `PhoneNum`) VALUES (" . $conn->quote($username) . "," . $conn->quote($email) . "," . $conn->quote($pwd_hash) . "," . $conn->quote($country) . "," . $conn->quote($city) . "," . $conn->quote($postcode) . "," . $conn->quote($phone).")";

                        $query = $conn->prepare($insert_customer);
                        $query->execute();

                        if($query->rowCount() > 0){
                            header("Location: homepage.php");
                        }
                    }
                }




            }
    
        }
        // Hash the password.
        // First verify if the email and username exist in DB

        // DOES EXIST.
            // Display an error saying that the user already exist.
        
        // DOES NOT EXIST
            // Add the user to the DB and redirect to homepage.
    }



?>