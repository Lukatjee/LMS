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

include __DIR__ . '/../../../controllers/commander.cont.php';

$qry = 'SELECT * FROM lms_roles';
$res = fetch($qry, []);

if (isset($_POST["crt"])) {

    create_role([$_POST["dpn"]]);
    unset($_POST);

}

?>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-10 col-md-8 gy-5 table-responsive">

            <table class="table table-light">

                <thead>

                <tr>

                    <th scope="col">ID</th>
                    <th scope="col">NAME</th>
                    <th scope="col">USERS</th>

                </tr>

                </thead>

                <tbody>

                <?php foreach ($res as $role) { ?>

                    <tr>

                        <td><?php echo $role['role_id'] ?></td>
                        <td><?php echo $role['role_name'] ?></td>
                        <td>

                            <?php

                            $res = fetch('SELECT DISTINCT COUNT(role_id) AS amount FROM users WHERE role_id = ? ORDER BY user_uid', [$role['role_id']]);

                            if (!empty($res)) {
                                echo $res[0]['amount'];
                            }

                            ?>

                        </td>

                    </tr>


                <?php } ?>

                </tbody>

            </table>

            <?php echo is_cmd($_SESSION['uid']) ? '<button type="button" class="btn rounded-0 shadow-none btn-primary" data-bs-toggle="modal" data-bs-target="#addGroup">Toevoegen</button>' : ""; ?>

            <div class="modal fade" id="addGroup" tabindex="-1" aria-hidden="true">

                <div class="modal-dialog">

                    <div class="modal-content rounded-0 border-0">

                        <form method="post">

                            <div class="modal-header">

                                <h5 class="modal-title">Rol toevoegen</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                            </div>

                            <div class="modal-body input-group">

                                <span class="input-group-text rounded-0 bg-success bg-opacity-25">
                                    <i class="bi bi-pencil-square"></i>
                                </span>

                                <input type="text" class="form-control rounded-0 shadow-none" aria-label="dpn" name="dpn" id="dpn">

                            </div>

                            <div class="modal-footer">

                                <button type="submit" name="crt" class="btn btn-primary rounded-0">Opslaan</button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

