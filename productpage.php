<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    include "Essential_tags/AJAX_TAG.php";
    include "Essential_tags/Common_TAG.php";
    ?>

    <title>FutureTech -- Product Page</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/4.0.10/marked.min.js"></script>

    <script src="JS/live-search.js" async></script>
</head>

<body>


    <?php
    include "Menu\menu-list.php";
    include "Forms\Search-function.php";
    ?>
    <div class="container p-4">
        <a href="homepage.php" class="p-2 btn btn-info"><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-arrow-left">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M16 12H8" />
                    <path d="m12 8-4 4 4 4" />
                </svg></span>Back to Homepage</a>

    </div>
    <?php
    include "product-search/product-search.php";
    ?>

    <script>
        function convertMarkdown() {
            var markdownText = document.getElementById('markdown').value;
            var htmlContent = marked(markdownText);
            document.getElementById('output').innerHTML = htmlContent;
        }

        // Convert Markdown on page load
        window.onload = function() {
            convertMarkdown();
        };
    </script>
</body>

</html>