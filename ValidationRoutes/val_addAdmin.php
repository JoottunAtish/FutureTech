<?php
    include "DB_CONNECTIONS\PDO_CONNECT.php";

    $pwd_err = "";
    if (!(isset($_SESSION["username"]) || isset($_SESSION["email"]))){
        $_SESSION["username"] = "";
        $_SESSION["email"] = "";
        $_SESSION["role"] = "";

        
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $username = $_POST['adminname'];

        $pwd_1 = $_POST['pass_1'];
        $pwd_2 = $_POST['pass_2'];
        $role = $_POST['role'];


        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
        $_SESSION["role"] = $role;

        // Verify the passwords.
        if (!preg_match("/^[a-zA-Z0-9\W]{6,}$/", $pwd_1)){
            $pwd_err = "Password is not secure enough. Please has atleast 6 characters!!";
        } else{

            if ($pwd_1 != $pwd_2){
                $pwd_err = "Passwords are not the same!";
            } else{
                $check_admin_sql = "SELECT * FROM admin WHERE Email = :mail ;";

                // Check for admin:
                $admin_query = $conn->prepare($check_admin_sql);
                $admin_query->execute(array('mail'=>$email));

                if ($admin_query->rowCount() > 0){
                    $pwd_err = "Admin already exist!";
                } else{
                        $pwd_hash = password_hash($pwd_1, PASSWORD_DEFAULT);
                        $insert_admin = "INSERT INTO `admin` (`AdminName`, `Email`, `Password`, `AdminRole`) VALUES 
                        (" . $conn->quote($username) . "," . $conn->quote($email) . "," . $conn->quote($pwd_hash) . "," . $conn->quote($role) .") ;";

                        $query = $conn->prepare($insert_admin);
                        $query->execute();

                        if($query->rowCount() > 0){
                            header("Location: adminpage.php");
                        }
                    }
                }
            }

        }
?>