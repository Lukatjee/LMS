<?php

// Initialization

session_start();

require __DIR__ . "/../../Base/_header.php";
require __DIR__ . "/../../Base/_navcmd.php";
require __DIR__ . "/../../../Controllers/user.cont.php";

if (!is_active())
    redirect("index.php", true);

$uid = $_SESSION["user_id"];

$commander_controller = new commander_controller($uid);

if (!$commander_controller->get_is_admin())
    redirect("Templates/Console/index.php", false);

// Handle form posts

if (isset($_POST["smt"])) {

    unset($_SESSION['error']);

    $commander_controller->createUser($_POST['eml'], $_POST['uid'], $_POST['pwd'], $_POST['role'], $_POST['cls']);

}

?>

<div class="container mt-5">

    <form method="post" class="col">

        <div class="row justify-content-center">

            <div class="col-10 col-md-8 col-lg-4">

                <!-- E-mail -->

                <div class="mb-3">

                    <label for="eml" class="form-label">E-mailadres</label>
                    <input type="email" class="form-control" name="eml" id="eml">

                </div>

                <!-- Username -->

                <div class="mb-3">

                    <label for="uid" class="form-label">Gebruikersnaam</label>
                    <input type="text" class="form-control" name="uid" id="uid">

                </div>

                <!-- Password -->

                <div class="mb-3">

                    <label for="pwd" class="form-label">Paswoord</label>
                    <input type="password" class="form-control" name="pwd" id="pwd">

                </div>

                <!-- Grouped inputs -->

                <div class="row">

                    <!-- Role -->

                    <div class="mb-3 col">

                        <label for="role" class="form-label">Rol</label>
                        <select class="form-select form-control" name="role" id="role">

                            <option selected value="leerling">Leerling</option>
                            <option value="leerkracht">Leerkracht</option>

                        </select>

                    </div>

                    <!-- Class -->

                    <div class="mb-3 col">

                        <label for="cls" class="form-label">Klas ID</label>
                        <input type="text" class="form-control" name="cls" id="cls">

                    </div>

                </div>

            </div>

            <div class="w-100"></div>

            <div class="col-10 col-md-8 col-lg-4 mt-3">

                <input name="smt" type="submit" class="btn btn-success" value="Opslaan">

            </div>

        </div>

    </form>

    <?php echo $_SESSION['error'] ?>

</div>