<nav>
    <div class="logo">
        sample logo here
    </div>

    <div class="menu">
        <a href="Menu/parts.php">PC Parts</a>
        <a href="Menu/pre-builts.php">Pre-Built Computers</a>
        <a href="Menu/accessories.php">Computer Accessories</a>
    </div>

    <div class="account">
        <?php
                if (isset($_SESSION["username"]) && !empty($_SESSION["username"])){
                    echo '<a href="account.php">';
                    echo htmlspecialchars($_SESSION['username']);
                    echo '</a>';
                } else {
                    echo '<a href="login.php">';
                    echo "Sign-up/log-in";
                    echo '</a>';
                }
            ?>
        
    </div>
</nav>