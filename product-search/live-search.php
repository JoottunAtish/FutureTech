<?php
    include("..\DB_CONNECTIONS\PDO_CONNECT.php");

    if (isset($_POST['input'])){
        $user_in = $_POST['input'];

        $user_in = addslashes($user_in);

        $query = "SELECT * FROM `product` WHERE ProductName LIKE '%{$user_in}%' OR  Description LIKE '%{$user_in}%'" ;

        $res = $conn->prepare($query);
        $res->execute();

        if ($res->rowCount() > 0){
            while($result = $res->fetch(PDO::FETCH_ASSOC)){

                $pid = $result['ProductID'];
                $Pname = $result['ProductName'];
                $Pprice = $result['ProductPrice'];
                ?>
                    <p><?php echo "$pid --> $Pname --> $Pprice"; ?></p>
                <?php
            }
            
        } else{
            echo "Nothing to display!";
        }


    }
?>