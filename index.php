<?php

// Initialization

session_start();

require __DIR__ . "/Templates/Base/_header.php";
require __DIR__ . "/Controllers/signin.cont.php";

if (is_active())
    redirect("./Templates/Console/index.php", false);

// Handle form posts

if (isset($_POST["smt"])) {

    unset($_SESSION['error']);

    $sign_in = new sign_in_controller($_POST['uid'], $_POST['pwd']);
    $sign_in->validate();

}

?>

<div class="container position-absolute top-50 start-50 translate-middle">

    <form method="post">

        <div class="mb-3">
            <label for="uid" class="form-label">Gebruikersnaam</label>
            <input type="text" id="uid" class="form-control" name="uid">
        </div>

        <div class="mb-3">
            <label for="pwd" class="form-label">Paswoord</label>
            <input type="password" id="pwd" class="form-control" name="pwd">
        </div>

        <input type="submit" class="btn btn-success" value="Inloggen" name="smt">

    </form>

    <?php echo $_SESSION['error'] ?>

</div>