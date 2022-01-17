<nav class="navbar navbar-expand-md navbar-dark">

    <div class="container bg-danger bg-gradient py-2 px-5">

        <a class="navbar-brand" href="./index.php">

            Zorion-LMS

        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto">

                <!--
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/Templates/Console/index.php">Console</a>
                </li>
                -->

            </ul>

            <div class="d-grid gap-2 d-md-block bg-dark p-2">

                <?php

                if (is_cmd($_SESSION['uid'])) {
                    echo '<a href="/Templates/Commander/index.php" class="btn bg-dark border-secondary text-white rounded-0 shadow-none"><i class="bi bi-gear-wide-connected"></i></a>';
                }

                ?>

                <a href="/services/signout.serv.php" class="btn bg-danger text-white rounded-0 shadow-none"><i class="bi bi-box-arrow-right"></i></a>

            </div>

        </div>

    </div>

</nav>