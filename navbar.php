<?php
    function navbarStatus($slug) {
        $serverSlug = $_SERVER['REQUEST_URI'];

        if($slug == "/") { //for Homepage
            return $serverSlug === $slug;
        }

        // Url, slug'ı içeriyorsa (/potterhead/app/characters.php)
        return strpos($serverSlug,$slug) !== false;
    }
?>

<div class="bg-white" style="box-shadow: 0px 2px 5px #b1b1b175;">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="index.php">
                <img src="assets/images/menu-logo.png" style="width:220px" alt="Potterhead Logo">
            </a>
            <button class=" navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo navbarStatus("/index.php") || navbarStatus("/") ? 'active' : '' ?>" href="index.php">Anasayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo navbarStatus("/characters.php") ? 'active' : '' ?>" href="characters.php">Karakterler</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo navbarStatus("/houses.php") ? 'active' : '' ?>" href="houses.php">Binalar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo navbarStatus("/spells.php") ? 'active' : '' ?>" href="spells.php">Büyüler</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
