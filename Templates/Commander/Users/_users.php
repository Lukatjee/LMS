<?php

session_start();

include __DIR__ . "/../../Base/_header.php";

if (!isset($_SESSION['uid'])) {
    redirect('index.php');
}

include __DIR__ . "/../../Base/_nav.cmd.php";

if (!is_cmd($_SESSION['uid'])) {
    redirect('Templates/Console/index.php');
}

$qry = 'SELECT DISTINCT user_id, email, user_uid, group_id, role_id FROM users GROUP BY user_uid';
$res = fetch($qry, []);

?>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-10 col-md-8 gy-5 table-responsive">

            <table class="table table-light">

                <thead>

                <tr>

                    <th scope="col">ID</th>
                    <th scope="col">E-MAIL</th>
                    <th scope="col">UID</th>
                    <th scope="col">GROUP</th>

                </tr>

                </thead>

                <tbody>

                <?php foreach ($res as $user) { ?>

                    <tr>

                        <td><?php echo $user['user_id'] ?></td>
                        <td><?php echo($user['role_id'] === 0 ? $user['email'] . ' <i class="bi bi-star-fill text-warning fs-6"></i>' : $user['email']) ?></td>
                        <td><?php echo $user['user_uid'] ?></td>
                        <td><?php $res = fetch('SELECT name FROM lms_groups WHERE id = ?', [$user['group_id']]); echo $res[0]['name'] ?></td>

                    </tr>


                <?php } ?>

                </tbody>

            </table>

            <?php echo is_cmd($_SESSION['uid']) ? '<a href="/Templates/Commander/Users/_adduser.php" type="button" class="btn btn-primary rounded-0">Toevoegen</a>' : ""; ?>

        </div>

    </div>

</div>