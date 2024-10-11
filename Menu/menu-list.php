<nav class="navbar navbar-expand-lg p-3 bg-light sticky-top">
    <a href="../../futuretech/homepage.php" class="navbar-brand">
        <img src="../../futuretech/images/Logo/Logo.png" alt="Futuretech Logo" width="50" style="vertical-align:bottom">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto col">
            <li>
                <a class="nav-link active" href="../../futuretech/Menu/parts.php">PC Parts</a>
            </li>

            <li class="nav-item">
                <a class="nav-link active" href="../../futuretech/Menu/pre-builts.php">Pre-Built Computers</a>
            </li>

            <li>
                <a class="nav-link active" href="../../futuretech/Menu/accessories.php">Computer Accessories</a>
            </li>
        </ul>

        <div class="navbar">
            <?php
            if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
            ?>
                <?php

                ?>
                <a class="nav-link" href="../../futuretech/account.php"> <?php echo htmlspecialchars($_SESSION['username']); ?></a>

            <?php
            } else {
            ?>
                <a class="nav-link" href="../../futuretech/login.php">Sign-up/log-in</a>
            <?php
            }
            ?>

        </div>
    </div>

</nav>