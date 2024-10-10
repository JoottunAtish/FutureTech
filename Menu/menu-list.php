<nav class="navbar navbar-expand-lg p-3 bg-white sticky-top">
    <a href="http://localhost:7777/futuretech/homepage.php" class="navbar-brand">
        <img src= "images\Logo\Logo.png" alt="Futuretech Logo" width="50" style="vertical-align:bottom">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto col">
            <li>
                <a class="nav-link active" href="http://localhost:7777/futuretech/Menu/parts.php">PC Parts</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="http://localhost:7777/futuretech/Menu/pre-builts.php">Pre-Built Computers</a>
            </li>

            <li>
                <a class="nav-link" href="http://localhost:7777/futuretech/Menu/accessories.php">Computer Accessories</a>
            </li>
        </ul>

        <div class="">
            <?php
                    if (isset($_SESSION["username"]) && !empty($_SESSION["username"])){
                        echo '<a class="nav-link" href="account.php">';
                        echo htmlspecialchars($_SESSION['username']);
                        echo '</a>';
                    } else {
                        echo '<a class="nav-link" href="login.php">';
                        echo "Sign-up/log-in";
                        echo '</a>';
                    }
                ?>
            
        </div>
    </div>

</nav>