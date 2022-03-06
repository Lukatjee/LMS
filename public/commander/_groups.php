<?php

session_start();

require_once dirname(__FILE__) . "/../../includes/header.inc.php";

if (!isset($_SESSION['uid'])) {
    redirect('index.php');
}

require_once dirname(__FILE__) . "/../../includes/nav.cmd.inc.php";

if (!is_cmd($_SESSION['uid'])) {
    redirect('public/_console.php');
}

require_once dirname(__FILE__) . "/../../controllers/commander.cont.php";

$qry = 'SELECT * FROM lms_groups';
$res = fetch($qry, []);

if (isset($_POST["crt"])) {

    create_group([$_POST["dpn"]]);
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

                <?php foreach ($res as $group) { ?>

                    <tr>

                        <td><?php echo $group['id'] ?></td>
                        <td><?php echo $group['name'] ?></td>
                        <td>

                            <?php

                            $res = fetch('SELECT DISTINCT COUNT(group_id) AS amount FROM users WHERE group_id = ? ORDER BY user_uid', [$group['id']]);

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

                                <h5 class="modal-title">Groep aanmaken</h5>
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

