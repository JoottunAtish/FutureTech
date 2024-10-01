<?php
    // Sessions should not be included as it will create a 
    // security flaws.
    include "DB_CONNECTIONS\PDO_CONNECT.php";
    $usr_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST"){     
        $mail = $_POST['username'];
        $user_pwd = $_POST['pass']; 

        if (empty($user_pwd) && empty($mail)){
            $msg = "Email or password cannot be empty.";
        } else {
        try{ 
                $sql_customer = "SELECT * FROM customer WHERE Email = :mail AND Password = :user_pwd ;";
                $sql_admin = "SELECT * FROM admin WHERE Email = :mail AND Password = :user_pwd ;";

                $customer_query = $conn->prepare($sql_customer);
                $customer_query->execute(array('mail' => $mail, 'user_pwd' => $user_pwd));
                $customer_count = $customer_query->rowCount();
                
                if ($customer_count > 0){
                    header("Location: http://localhost:7777/futuretech/route\Main Pages\homepage.php");
                    die();
                    
                } else {
                    $admin_query = $conn->prepare($sql_admin);
                    $admin_query->execute(array('mail' => $mail, 'user_pwd' => $user_pwd));
        
                    if ($admin_query->rowCount() > 0){
                        header("Location: http://localhost:7777/futuretech/route\Main Pages\adminpage.php");
                        die();
                    } else{
                        $usr_err = "Error in email and password";
                    }
                }

                
            } catch (PDOException $e){
                echo "$e->message()";
            }

        }
    }



?>