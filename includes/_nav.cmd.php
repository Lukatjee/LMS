<?php

require_once dirname(__FILE__) . "/../services/_functions.php";

?>

<header class="pb-3">

    <nav class="navbar navbar-expand-md navbar-dark bg-dark border-secondary border-bottom">

        <div class="container">

            <a class="navbar-brand fw-light" href="">Zorion-LMS</a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">

                        <a class="nav-link text-white text-decoration-none" href="/public/commander/_users.php">
                            <i class="bi bi-file-earmark-person-fill"></i> Gebruikers
                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link text-white text-decoration-none" href="/public/commander/_roles.php">
                            <i class="bi bi-nut-fill"></i> Rollen
                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link text-white text-decoration-none" href="/public/commander/_groups.php">
                            <i class="bi bi-bookmark-fill"></i> Groepen
                        </a>

                    </li>

                </ul>

                <form class="d-flex gap-2">

                    <a href="/public/index.console.php" class="btn bg-primary text-white shadow-none rounded-0 w-50">
                        <i class="bi bi-person-workspace"></i>
                    </a>

                    <a href="/services/_signout.php" class="btn bg-danger text-white shadow-none rounded-0 w-50">
                        <i class="bi bi-box-arrow-right"></i>
                    </a>

                </form>

            </div>

        </div>

    </nav>

</header>