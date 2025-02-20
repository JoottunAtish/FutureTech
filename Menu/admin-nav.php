<nav class="navbar navbar-expand-lg p-3 bg-light sticky-top d-flex">
    <a href="../../futuretech/adminpage.php" class="navbar-brand">
        <img src="../../futuretech/images/Logo/Logo.png" alt="Futuretech Logo" width="50" style="vertical-align:bottom">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="navbar">
            <?php
            if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
            ?>
                <?php

                ?>
                <a class="nav-link"  href="../../futuretech/account.php">
                    <div class="bg-primary p-2 m-1 text-white rounded">
                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </div>
                </a>

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