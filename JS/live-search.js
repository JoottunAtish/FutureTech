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
                    $(".search-dislay").html(data);
                }
            });
        } else {
            $(".search-dislay").html("");
        }
    });
});