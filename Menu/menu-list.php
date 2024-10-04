<nav>
    <div class="logo">
        sample logo here
    </div>

    <div class="menu">
        <a href="\parts">PC Parts</a>
        <a href="\pre-builts">Pre-Built Computers</a>
        <a href="\accessories">Computer Accessories</a>
    </div>

    <div class="account">
        <a href="..\..\Login.php">

            <?php
                if (isset($_SESSION["username"])){
                    echo $_SESSION['username'];
                } else {
                    echo "Sign-up/log-in";
                }
            ?>
        </a>
    </div>
</nav>