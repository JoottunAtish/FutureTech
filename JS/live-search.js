$(document).ready(function () {
    var All_limit = 9;
    var deal_limit = 3;
    $(".search-display").html("");
    $.ajax({
        url: "http://localhost:7777/futuretech/Defaultcard/default_homecard.php",
        method: "POST",
        data: { all: All_limit, deal: deal_limit },
        success: function (data) {
            $(".live-searh-default").html(data);
        }
    });

    $("#live-search").keyup(function () {

        var input = $(this).val();
        // alert(input);

        if (input != "") {
            $.ajax({
                url: "http://localhost:7777/futuretech/product-search/live-search.php",
                method: "POST",
                data: { input: input },

                success: function (data) {
                    $(".search-display").html(data);
                    $(".live-searh-default").html("");
                }
            });
        } else {
            $(".search-display").html("");
            $.ajax({
                url: "http://localhost:7777/futuretech/Defaultcard/default_homecard.php",
                method: "POST",
                data: { all: All_limit, deal: deal_limit },

                success: function (data) {
                    $(".live-searh-default").html(data);
                }
            });
        }
    });

});