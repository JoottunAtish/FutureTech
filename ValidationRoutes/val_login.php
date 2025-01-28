<?php
    include "DB_CONNECTIONS\PDO_CONNECT.php";
    $usr_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST"){     
        $mail = $_POST['email'];
        $user_pwd = $_POST['pass'];

        $_SESSION['email'] = $_POST['email'];

        if (empty($user_pwd) && empty($mail)){
            $msg = "Email or password cannot be empty.";
        } else {
        try{ 
                $sql_customer = "SELECT * FROM `customer` WHERE Email = :mail ;";
                $sql_admin = "SELECT * FROM `admin` WHERE Email = :mail ;";

                $customer_query = $conn->prepare($sql_customer);
                $customer_query->execute(array('mail' => $mail));
                $customer_count = $customer_query->rowCount();
                
                if ($customer_count > 0){
                    $result = $customer_query->fetch(PDO::FETCH_ASSOC);

                    if (password_verify($user_pwd, $result['Password'])){
                        $_SESSION["username"] = $result['UserName'];
                        $_SESSION["email"] = $result['Email'];
                        header("Location: homepage.php");
                        die();
                    } else{
                        $usr_err = "Error in email and password";
                    }
                    
                } else {

                    $admin_query = $conn->prepare($sql_admin);
                    $admin_query->execute(array('mail' => $mail));

                    if ($admin_query->rowCount() > 0){
                        $result = $admin_query->fetch(PDO::FETCH_ASSOC);
                        
                        if (password_verify($user_pwd, $result['Password'])){
                            $_SESSION["username"] = $result['AdminName'];
                            $_SESSION["email"] = $result['Email'];
                            header("Location: adminpage.php");
                            die();
                        }else{
                            $usr_err = "Error in email and password";
                        }


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