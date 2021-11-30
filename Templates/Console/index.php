<?php

include dirname(__FILE__) . "/../Base/_header.php";
include dirname(__FILE__) . "/../../controllers/Commander.cont.php";

$commander_controller = new commander_controller($_SESSION["uid"]);
$commander_controller->display_commander();

?>

<h1>Yes</h1>

<?php

include dirname(__FILE__) . "/../Base/_footer.php";

?>
