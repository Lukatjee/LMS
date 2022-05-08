<?php

	require_once dirname(__FILE__) . "/../../../includes/cmd.inc.php";

	# Get the class id from the get request
	$id = $_GET['id'];

	# Fetch all date from the classlist table
	$res = fetch('SELECT name, grade FROM classlist WHERE id=?;', [$id])[0];

	# Fetch all the members that are in this group
	$members = fetch('SELECT u.id, u.username FROM user AS u LEFT JOIN student s on u.id = s.user_id WHERE s.classlist_id=?;', [$id]);

	# Fetch all the users that are not in a group yet
	$users = fetch('SELECT s.user_id, u.username FROM student s LEFT JOIN user u on u.id = s.user_id WHERE s.classlist_id IS NULL;', []);

	# Purges the group and all the associated data in other tables
	if (isset($_POST['delete_group'])) {
		delete_group($id);
	}

	# Updates properties of the group entered by the user
	if (isset($_POST['edit_group'])) {
		update_group($id, [$_POST['group_name'], $_POST['group_grade']]);
	}

	# Adds users to the group that have been specified through a select menu
	if (isset($_POST['add_users']) && isset($_POST['members'])) {
		add_users_to_group([$id, $_POST['members']]);
	}

	# Removes a user from the group
	if (isset($_POST['remove_user'])) {
		remove_user_from_group($id, $_POST['remove_user']);
	}

	unset($_POST);

?>

<div class="container">

    <div class="row justify-content-center py-5">

        <div class="col-sm-5">

            <div class="card rounded-0 mb-3">

                <div class="card-header bg-dark text-light rounded-0">
                    Eigenschappen
                    <p class="card-subtitle mb-2 text-light text-muted"><sub>Bekijk en/of bewerk de eigenschappen van <strong><?php echo $res['name'] ?></strong></sub></p>
                </div>

                <div class="card-body">

                    <form method="post">

                        <div class="row">

                            <div class="col">

                                <label for="name" class="form-label">Klasnaam</label>
                                <input type="text" name="group_name" class="form-control rounded-0 shadow-none" value="<?php echo $res['name'] ?>" aria-label="name">

                            </div>

                            <div class="col">

                                <label for="grade" class="form-label">Graad</label>
                                <input type="number" name="group_grade" class="form-control rounded-0 shadow-none" value="<?php echo $res['grade'] ?>" aria-label="grade">

                            </div>

                        </div>

                        <hr class="bg-dark border-secondary border-bottom">

                        <div class="d-grid d-flex gap-2 justify-content-md-end">

                            <button type="submit" name="delete_group" class="btn btn-sm btn-danger rounded-0 shadow-none"><i class="bi bi-trash"></i></button>
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
                    <p class="card-subtitle mb-2 text-light text-muted"><sub>Een overzicht van alle leerlingen in <strong><?php echo $res['name'] ?></strong> en de optie om leerlingen toe te voegen indien mogelijk.</sub></p>
                </div>

                <div class="card-body table-responsive">

					<?php if (!empty($members)) { ?>

                        <table class="table">

                            <thead>

                            <tr>

                                <th scope="col">Id</th>
                                <th scope="col">Gebruikersnaam</th>
                                <th scope="col"></th>

                            </tr>

                            </thead>

                            <tbody>

							<?php foreach ($members as $member) { ?>

                                <tr>

                                    <td><?php echo $member['id'] ?></td>
                                    <td><?php echo $member['username'] ?></td>

                                    <td class="text-center">

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
										echo '<option value="' . $user['user_id'] . '">' . $user['username'] . '</option>';
									} ?>


                                </select>

                                <button type="submit" name="add_users" class="btn btn-sm btn-primary rounded-0 shadow-none">Toevoegen</button>

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
        $('#students').select2(); // Initalize the select input field with the Select2 library
    })

</script>