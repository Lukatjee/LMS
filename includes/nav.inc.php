<nav class="navbar navbar-expand-md navbar-dark bg-dark border-secondary border-bottom">

    <div class="container">

        <a class="navbar-brand fw-light" href="/public/_console.php">Zorion-LMS</a>

        <!-- Toggler (responsivity) -->

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <!-- Timetable -->

                <li class="nav-item">

                    <a class="nav-link text-light text-decoration-none" href="/public/console/_timetable.php">
                        <i class="bi bi-clock"></i> Lessenrooster
                    </a>

                </li>

                <!-- Schedule -->

                <li class="nav-item">

                    <a class="nav-link text-light text-decoration-none" href="/public/console/_calendar.php">
                        <i class="bi bi-table"></i> Planning
                    </a>

                </li>

            </ul>

            <form class="d-flex gap-2">

                <!-- Commander & Signout -->

                <?php

                if (is_cmd($_SESSION['uid'])) {

                    echo '<a href="/public/_commander.php" class="btn bg-primary text-light shadow-none rounded-0 w-50"><i class="bi bi-gear-wide-connected"></i></a>';
                    echo '<a href="/services/signout.serv.php" class="btn bg-danger text-white shadow-none rounded-0 w-50"><i class="bi bi-box-arrow-right"></i></a>';

                } else {

                    echo '<a href="/services/signout.serv.php" class="btn bg-danger text-light shadow-none rounded-0 w-100"><i class="bi bi-box-arrow-right"></i></a>';

                }

                ?>

            </form>

        </div>

    </div>

</nav>