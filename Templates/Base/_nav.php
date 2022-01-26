<nav class="navbar navbar-expand-md navbar-dark bg-dark border-secondary border-bottom">

    <div class="container">

        <a class="navbar-brand fw-light" href="./">Zorion-LMS</a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- This feels weird, but I'll allow it. -->
            </ul>

            <form class="d-flex gap-2">

                <?php

                if (is_cmd($_SESSION['uid'])) {

                    echo '<a href="/Templates/Commander/index.php" class="btn bg-primary text-white shadow-none rounded-0 w-50"><i class="bi bi-gear-wide-connected"></i></a>';
                    echo '<a href="/services/_signout.php" class="btn bg-danger text-white shadow-none rounded-0 w-50"><i class="bi bi-box-arrow-right"></i></a>';

                } else {

                    echo '<a href="/services/_signout.php" class="btn bg-danger text-white shadow-none rounded-0 w-100"><i class="bi bi-box-arrow-right"></i></a>';

                }

                ?>

            </form>

        </div>

    </div>

</nav>