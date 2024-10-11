$(document).ready(function () {
    $(".search-display").html("");
    const deal_limit = 5;
    const all_limit = 10;
    
    $.ajax({
        url: "../../futuretech/Defaultcard/default_accessories.php",
        method: "POST",
        data: { all: all_limit, deal: deal_limit },
        success: function (data) {
            document.getElementById('search-display-header').style.visibility = 'hidden';
            $(".live-search-default").html(data);
        }
    });

    $("#live-search").keyup(function () {
        console.log("reached");

        var input = $(this).val();
        // alert(input);

        if (input != "") {
            $.ajax({
                url: "../../futuretech/product-search/live-search.php",
                method: "POST",
                data: { input: input },

                success: function (data) {
                    document.getElementById('search-display-header').style.visibility = 'visible';
                    $(".search-display").html(data);
                    $(".live-search-default").html("");
                }
            });
        } else {
            $(".search-display").html("");
            $.ajax({
                url: "../../futuretech/Defaultcard/default_accessories.php",
                method: "POST",
                data: { all: all_limit, deal: deal_limit },

                success: function (data) {
                    $(".live-search-default").html(data);
                    document.getElementById('search-display-header').style.visibility = 'hidden';
                }
            });
        }
    });

});