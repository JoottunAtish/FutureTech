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
        <?php
                if (isset($_SESSION["username"])){
                    echo '<a href="account.php">';
                    echo $_SESSION['username'];
                    echo '</a>';
                } else {
                    echo '<a href="login.php">';
                    echo "Sign-up/log-in";
                    echo '</a>';
                }
            ?>
        
    </div>
</nav>