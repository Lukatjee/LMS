<?php

	session_start();

	require_once dirname(__FILE__) . "/../../includes/header.inc.php";

	if (!isset($_SESSION['uid'])) {
		redirect('public/index.php');
	}

	require_once dirname(__FILE__) . "/../../includes/nav.cmd.inc.php";

	if (!is_cmd($_SESSION['uid'])) {
		redirect('public/_console.php');
	}

	$qry = 'SELECT DISTINCT s.user_id, u.username, cl.name FROM student AS s LEFT JOIN user u on u.id = s.user_id LEFT JOIN classlist cl on cl.id = s.classlist_id GROUP BY u.username;';
	$res = fetch($qry, []);

?>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-10 col-md-8 gy-5 table-responsive">

            <table class="table table-light">

                <thead>

                <tr>

                    <th scope="col">ID</th>
                    <th scope="col">GEBRUIKERSNAAM</th>
                    <th scope="col">KLAS</th>

                </tr>

                </thead>

                <tbody>

				<?php foreach ($res as $user) { ?>

                    <tr>

                        <td><?php echo $user['user_id'] ?></td>
                        <td><?php echo $user['username'] ?></td>
                        <td><?php echo $user['name'] ?></td>

                    </tr>


				<?php } ?>

                </tbody>

            </table>

			<?php echo is_cmd($_SESSION['uid']) ? '<a href="" type="button" class="btn disabled btn-primary rounded-0">Toevoegen</a>' : ""; ?>

        </div>

    </div>

</div>