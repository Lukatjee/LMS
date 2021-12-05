<?php

session_start();

unset($_SESSION['error']);

require __DIR__ . "/../../Base/_header.php";
require __DIR__ . "/../../Base/_navcmd.php";
require __DIR__ . "/../../../Controllers/commander.cont.php";

if (!is_active())
    redirect("index.php", true);

$uid = $_SESSION["user_id"];

$commander_controller = new commander_controller($uid);

if (!$commander_controller->get_is_admin())
    redirect("Templates/Console/index.php", false);

$users = $commander_controller->fetch();

?>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-10 col-md-8 gy-5 table-responsive">

            <table class="table table-hover table-dark text-light ">

                <thead>

                <tr>

                    <th scope="col">ID</th>
                    <th scope="col">Email</th>
                    <th scope="col">UID</th>
                    <th scope="col">Rol</th>

                </tr>

                </thead>

                <tbody>

                <?php foreach ($users as $user) { ?>

                    <tr>

                        <td><?php echo $user['user_id'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $user['user_uid'] ?></td>
                        <td><?php echo $user['role'] ?></td>

                    </tr>


                <?php } ?>

                </tbody>

            </table>

        </div>

        <div class="w-100"></div>

        <div class="col-10 col-md-8">

            <a href="/Templates/Commander/Users/_adduser.php" type="button" class="btn btn-success">Toevoegen</a>

        </div>

    </div>

    <?php echo $_SESSION['error'] ?>

</div>