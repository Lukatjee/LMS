<?php

	# Initalization of the webpage

	session_start();

	require_once dirname(__FILE__) . "/../../../includes/header.inc.php";

	if (!isset($_SESSION['uid'])) {
		redirect('index.php');
	}

	require_once dirname(__FILE__) . "/../../../includes/nav.cmd.inc.php";

	if (!is_cmd($_SESSION['uid'])) {
		redirect('public/_console.php');
	}

	require_once dirname(__FILE__) . "/../../../controllers/commander.cont.php";

	$id = $_GET['id'];

	# Fetch properties that belong to the specific group
	$data = fetch('SELECT name, grade FROM classlist WHERE id=?;', [$id])[0];

	# Fetch the members that are in this group
	$members = fetch('SELECT u.id, u.username FROM user AS u LEFT JOIN student s on u.id = s.user_id WHERE s.classlist_id=?;', [$id]);

	# Fetch users that aren't in a group yet
	$users = fetch('SELECT u.id, u.username FROM user AS u LEFT JOIN student s on u.id = s.user_id WHERE s.classlist_id IS NULL;', []);

    if (isset($_POST['edit_group'])) {
        update_group($id, [$_POST['group_name'], $_POST['group_grade']]);
    }

	# Handles post event 'add_users'
	if (isset($_POST['add_users'])) {
		add_user_to_group([$id, $_POST['members']]);
	}

	# Handles post event 'remove_user'
	if (isset($_POST['remove_user'])) {
		edit("UPDATE student AS s SET s.classlist_id = null WHERE s.user_id = ?;", [$_POST['remove_user']]);
		echo("<meta http-equiv='refresh' content='0'>");
	}

	unset($_POST);

?>

<div class="container">

    <div class="row justify-content-center py-5">

        <div class="col-sm-5">

            <div class="card rounded-0 mb-3">

                <div class="card-header bg-dark text-light rounded-0">
                    Eigenschappen
                    <p class="card-subtitle mb-2 text-light text-muted"><sub>Bekijk en/of bewerk de eigenschappen van <strong><?php echo $data['name'] ?></strong></sub></p>
                </div>

                <div class="card-body">

                    <form method="post">

                        <div class="row">

                            <div class="col">
                                <label for="name" class="form-label">Klasnaam</label>
                                <input type="text" name="group_name" class="form-control rounded-0 shadow-none" value="<?php echo $data['name'] ?>" aria-label="name">
                            </div>

                            <div class="col">
                                <label for="grade" class="form-label">Graad</label>
                                <input type="number" name="group_grade" class="form-control rounded-0 shadow-none" value="<?php echo $data['grade'] ?>" aria-label="grade">
                            </div>

                        </div>

                        <hr class="bg-dark border-secondary border-bottom">

                        <div class="d-grid gap-2 justify-content-md-end">
                            <button type="submit" name="edit_group" class="btn btn-sm btn-primary rounded-0 shadow-none">Opslaan</button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

        <div class="col">

            <div class="card rounded-0 mb-3">

                <div class="card-header bg-dark text-light rounded-0">
                    Leerlingen
                    <p class="card-subtitle mb-2 text-light text-muted"><sub>Een overzicht van alle leerlingen in <strong><?php echo $data['name'] ?></strong> en de optie om leerlingen toe te voegen indien mogelijk.</sub></p>
                </div>

                <div class="card-body table-responsive">

					<?php if (!empty($members)) { ?>

                        <table class="table text-center">

                            <thead>

                            <tr>

                                <th scope="col">Id</th>
                                <th scope="col">Gebruikersnaam</th>
                                <th scope="col">Acties</th>

                            </tr>

                            </thead>

                            <tbody>

							<?php foreach ($members as $member) { ?>

                                <tr>

                                    <td><?php echo $member['id'] ?></td>
                                    <td><?php echo $member['username'] ?></td>
                                    <td>

                                        <form method="post">

                                            <button type="submit" name="remove_user" class="bg-transparent border-0" value="<?php echo $member['id'] ?>">
                                                <i class="bi text-danger bi-x-circle"></i>
                                            </button>

                                        </form>

                                    </td>

                                </tr>

							<?php } ?>

                            </tbody>

                        </table>

					<?php } else {
						echo '<p class="card-text text-center text-muted">Er zitten nog geen leerlingen in deze klas.</p>';
					} ?>

					<?php if (!empty($users)) { ?>

                        <hr class="bg-dark border-bottom border-secondary m-0 mb-3">

                        <form method="post">

                            <div class="d-grid gap-2 d-md-flex">

                                <select id="students" name="members[]" class="form-select" multiple="multiple" aria-label="students">

									<?php foreach ($users as $user) {
										echo '<option value="' . $user['id'] . '">' . $user['username'] . '</option>';
									} ?>


                                </select>

                                <button type="submit" name="add_users" class="btn btn-sm btn-primary shadow-none">Toevoegen</button>

                            </div>

                        </form>

					<?php } ?>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

    $(document).ready(function () {
        $('#students').select2();
    })

</script>