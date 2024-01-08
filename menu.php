<!-- menu.php -->



<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">Vinylmasters</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Kezdőoldal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="product.php">Termékek</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ujalbum.php">Új album felvitel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Rólunk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Kapcsolat</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['user_name'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="#">Üdv, <?php echo $_SESSION['user_name']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rendelesek.php">
                        <i class="fas fa-shopping-cart"></i> Rendelések
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <i class="fas fa-sign-out-alt"></i> Kijelentkezés
                    </a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="bejelentkezes.php">Bejelentkezés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="regisztracio.php">
                        <i class="fa fa-user-plus"></i> Regisztráció
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>
