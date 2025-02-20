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

        <div class="navbar d-flex gap-3 align-items-center">
            <?php
            if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
            ?>

                <a href="../../futuretech/cartpage.php">
                    <div class="bg-secondary p-2 text-white rounded" style="cursor:pointer;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart">
                            <circle cx="8" cy="21" r="1" />
                            <circle cx="19" cy="21" r="1" />
                            <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                        </svg>
                    </div>
                </a>

                <a class="nav-link " href="../../futuretech/account.php">
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