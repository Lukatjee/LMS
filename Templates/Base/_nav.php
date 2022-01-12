<nav class="navbar navbar-expand-md bg-success navbar-dark">

    <div class="container">

        <a class="navbar-brand" href="./index.php">

            Zorion-LMS

        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/Templates/Console/index.php">Console</a>
                </li>

            </ul>

            <div class="d-grid gap-2 d-md-block">

                <?php

                /*if ($_SESSION['is_commander']) {
                    echo '<a href="/Templates/Commander/index.php" class="btn btn-dark">Commander</a>';
                }*/

                ?>

                <a href="/services/signout.serv.php" class="btn btn-danger">Uitloggen</a>

            </div>

        </div>

    </div>

</nav>