<?php

	require_once dirname(__FILE__) . "/../../includes/cmd.inc.php";

	# Fetch all data concerning users
	$res = fetch('SELECT DISTINCT u.id, u.username FROM user AS u GROUP BY u.username;', []);

	# Creates a new user with given credentials
	if (isset($_POST['create_user'])) {
		create_user([$_POST['username'], $_POST['password']], isset($_POST['teacher']));
	}

	# Removes a user and any associations with it from other tables
	if (isset($_POST['delete_user'])) {
		delete_user($_POST['delete_user']);
	}

	unset($_POST)

?>

<div class="container">

    <div class="row py-5 justify-content-center">

        <div class="col table-responsive">

            <table class="table">

                <thead class="bg-dark text-light">

                <tr>

                    <th scope="col">Id</th>
                    <th scope="col">Gebruikersnaam</th>
                    <th scope="col" class="text-center">Rol</th>
                    <th scope="col" class="text-center"></th>

                </tr>

                </thead>

                <tbody>

				<?php foreach ($res as $user) { ?>

                    <tr>

                        <td><?php echo $user['id'] ?></td>
                        <td><?php echo "<a href=./user?id=" . $user['id'] . ">" . $user['username'] . "</a>"; ?></td>
                        <td class="text-center"><?php echo is_teacher($user['id']) ? '<i class="bi bi-eyeglasses"></i>' : '<i class="bi bi-mortarboard"></i>' ?></td>

                        <td class="text-center">

							<?php if ($_SESSION['uid'] != $user['id']) { ?>
                                <form method="post">

                                    <button type="submit" name="delete_user" class="bg-transparent border-0" value="<?php echo $user['id'] ?>">
                                        <i class="bi text-danger bi-x-circle"></i>
                                    </button>

                                </form>
							<?php } ?>

                        </td>

                    </tr>


				<?php } ?>

                </tbody>

            </table>

        </div>

        <div class="col-sm-4">

            <div class="card rounded-0 mb-3">

                <div class="card-header bg-dark text-light rounded-0">

                    Gebruiker aanmaken
                    <p class="card-subtitle mb-2 text-light text-muted"><sub>Maak een leerkracht- of leerlingenaccount aan.</sub></p>

                </div>

                <div class="card-body">

                    <form method="post">

                        <div class="row mb-3">

                            <div class="col">

                                <label for="username" class="form-label">Gebruikersnaam</label>
                                <input type="text" name="username" class="form-control rounded-0 shadow-none" aria-label="name">

                            </div>

                            <div class="col">

                                <label for="password" class="form-label">Wachtwoord</label>
                                <input type="password" name="password" class="form-control rounded-0 shadow-none" aria-label="grade">

                            </div>

                        </div>

                        <div class="form-check form-switch">

                            <label class="form-check-label" for="teacher">Leerkrachtenaccount</label>
                            <input class="form-check-input shadow-none" name="teacher" type="checkbox" role="switch" id="teacher">

                        </div>

                        <hr class="bg-dark border-secondary border-bottom">

                        <div class="d-grid gap-2 justify-content-md-end">
                            <button type="submit" name="create_user" class="btn btn-sm btn-primary rounded-0 shadow-none">Toevoegen</button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>