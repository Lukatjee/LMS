<nav class="navbar navbar-expand-md navbar-dark">

    <div class="container bg-success bg-gradient py-2 px-5 rounded-1">

        <a class="navbar-brand fw-bolder" href="./index.php">

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

            <div class="d-grid gap-2 d-md-block">

                <?php

                if (is_cmd($_SESSION['uid'])) {
                    echo '<a href="/Templates/Commander/index.php" class="btn bg-dark bg-gradient text-white rounded-pill shadow-none border-0"><i class="bi bi-gear-wide-connected"></i></a>';
                }

                ?>

                <a href="/services/_signout.php" class="btn bg-dark bg-gradient text-white rounded-pill shadow-none border-0"><i class="bi bi-box-arrow-right"></i></a>

            </div>

        </div>

    </div>

</nav>