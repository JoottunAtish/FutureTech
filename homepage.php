<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Menu\style-nav.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>FutureTech - Homepage</title>
</head>
<body>
    <?php
        include "Menu\menu-list.php";
    ?>

    <!-- Adding a search feature -->
    <input id='live-search' type="text" placeholder="Search...." >

    <div class="card-container">

    </div>
</body>

<script>
    $(document). ready(function(){
        $("#live-search").keyup(function(){

            var input = $(this).val();
            // alert(input);

            if (input != ""){
                $.ajax({
                    url: "product-search/live-search.php",
                    method: "POST",
                    data: {input: input},

                    success:function(data){
                        $(".card-container").html(data);
                    }
                });
            } else {
                $(".card-container").css("display", "none");
            }
        });
    });
</script>
</html>