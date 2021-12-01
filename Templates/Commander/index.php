<?php

session_start();

$dir = dirname(__FILE__);

include_once "$dir/../../Controllers/Commander.cont.php";
include_once "$dir/../Base/_header.php";

if (!is_active())
    redirect("index.php", true);

$uid = $_SESSION["user_id"];

$commander_controller = new commander_controller($uid);

if (!$commander_controller->get_admin())
    redirect("Templates/Console/index.php", false);

if (isset($_POST["smt"])) {

    unset($_SESSION['error']);

    if (!isset($_POST['cmd'])) {

        $_POST['cmd'] = "off";

    }

    $commander_controller->create_user($_POST['uid'], $_POST['pwd'], $_POST['cmd']);

}

?>

    <h1>Create User</h1>

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

        <label>

            Commander <input type="checkbox" name="cmd">

        </label>

        <br>
        <br>

        <input type="submit" value="Create" name="smt">

        <br>
        <br>

    </form>

    <?php echo $_SESSION["error"]; ?>

<?php include_once "$dir/../Base/_footer.php"; ?>