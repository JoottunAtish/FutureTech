$(document).ready(function(){
    $("#live-search").keyup(function(){

        var input = $(this).val();
        // alert(input);

        if (input != ""){
            $.ajax({
                url: "http://localhost:7777/futuretech/product-search/live-search.php",
                method: "POST",
                data: {input: input},

                success:function(data){
                    $(".search-display").html(data);
                }
            });
        } else {
            $(".search-display").html("");
        }
    });
});