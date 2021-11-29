<?php

include dirname(__FILE__) . "/Templates/Base/_header.php";
include dirname(__FILE__) . "/Controllers/Signin.cont.php";

if (isset($_POST["smt"]))
{

    $login = new signin_controller($_POST['uid'], $_POST['pwd']);
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

<?php include dirname(__FILE__) . "/Templates/Base/_footer.php"; ?>