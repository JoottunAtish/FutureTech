

$(document).ready(function () {
    $(".search-display").html("");

    $.ajax({
        url: "../../futuretech/Defaultcard/default_homecard.php",
        method: "POST",
        data: { all: 10, deal: 4 },
        success: function (data) {
            document.getElementById('search-display-header').style.visibility = 'hidden';
            $(".live-search-default").html(data);
        }
    });

    $("#live-search").keyup(function () {

        var input = $(this).val();

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
                url: "../../futuretech/Defaultcard/default_homecard.php",
                method: "POST",
                data: {},

                success: function (data) {
                    $(".live-search-default").html(data);
                    document.getElementById('search-display-header').style.visibility = 'hidden';
                }
            });
        }
    });

});