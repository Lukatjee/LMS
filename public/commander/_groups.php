<?php

	require_once dirname(__FILE__) . "/../../includes/cmd.inc.php";

	# Fetch the current groups from the database
	$res = fetch('SELECT * FROM classlist;', []);

	# Fetch users that are not in a group yet so they can be assigned during the creation process
	$users = fetch('SELECT u.id, u.username FROM user AS u LEFT JOIN student s on u.id = s.user_id WHERE s.classlist_id IS NULL;', []);

	# Create a group on pressing the create group button
	if (isset($_POST["create_group"])) {

		$dta = [$_POST["group_name"], $_POST["group_grade"]];
		$dta[] = $_POST['members'] ?? [];

		# Create a group with the given data
		create_group($dta);

	}

	unset($_POST);

?>

<div class="container">

    <div class="row py-5 justify-content-center">

        <div class="col table-responsive">

            <table class="table text-center">

                <thead class="bg-dark text-light">

                <tr>

                    <th scope="col">Id</th>
                    <th scope="col">Klasnaam</th>
                    <th scope="col">Graad</th>

                </tr>

                </thead>

                <tbody>

				<?php foreach ($res as $group) { ?>

                    <tr>

                        <td><?php echo $group['id'] ?></td>
                        <td><?php echo "<a href=./group?id=" . $group['id'] . ">" . $group['name'] . "</a>" ?></td>
                        <td><?php echo $group['grade'] ?></td>

                    </tr>

				<?php } ?>

                </tbody>

            </table>

        </div>

        <div class="col-sm-4">

            <div class="card rounded-0 mb-3">

                <div class="card-header bg-dark text-light rounded-0">
                    Groep aanmaken
                    <p class="card-subtitle mb-2 text-light text-muted"><sub>Maak een nieuwe klasgroep aan en voeg leerlingen toe.</sub></p>
                </div>

                <div class="card-body">

                    <form method="post">

                        <div class="row mb-3">

                            <div class="col">
                                <label for="name" class="form-label">Klasnaam</label>
                                <input type="text" name="group_name" class="form-control rounded-0 shadow-none" aria-label="name">
                            </div>

                            <div class="col">
                                <label for="grade" class="form-label">Graad</label>
                                <input type="number" name="group_grade" class="form-control rounded-0 shadow-none" aria-label="grade">
                            </div>

                        </div>

						<?php if (!empty($users)) { ?>

                            <select id="students" name="members[]" class="form-select" multiple="multiple" aria-label="students">

								<?php foreach ($users as $user) {
									echo '<option value="' . $user['id'] . '">' . $user['username'] . '</option>';
								} ?>

                            </select>

						<?php } ?>

                        <hr class="bg-dark border-secondary border-bottom">

                        <div class="d-grid gap-2 justify-content-md-end">
                            <button type="submit" name="create_group" class="btn btn-sm btn-primary rounded-0 shadow-none">Toevoegen</button>
                        </div>

                    </form>

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

