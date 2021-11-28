<?php

include "Templates/Base/_header.php";
include "Controllers/login.cont.php";

if (isset($_POST["smt"])) {

    $login = new login_controller($_POST['uid'], $_POST['pwd']);
    $login->authenticate();

}

?>

<form method="post">

    <label>

        Username:
        <br>
        <input type="text" name="uid">

    </label>

    <br>
    <br>

    <label>

        Password:
        <br>
        <input type="password" name="pwd">

    </label>

    <br>
    <br>

    <input type="submit" value="Sign In" name="smt">

    <br>
    <br>

</form>

<?php include "Templates/Base/_footer.php"; ?>