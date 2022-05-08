<?php

	require_once dirname(__FILE__) . "/../../../includes/cmd.inc.php";

	$id = $_GET['id'];

	$data = fetch('SELECT id, username FROM user WHERE id=?;', [$id])[0];
	$group = fetch('SELECT c.id, c.name FROM classlist c LEFT JOIN student s on c.id = s.classlist_id WHERE user_id = ?;', [$id])[0];

	if (isset($_POST['delete_user'])) {
		delete_user($id);
	}

	if (isset($_POST['edit_user'])) {
		update_user($id, [$_POST['username'], $_POST['password']]);
	}

?>

<div class="container">

    <div class="row justify-content-center py-5">

        <div class="col">

            <div class="card rounded-0 mb-3">

                <div class="card-header bg-dark text-light rounded-0">
                    Eigenschappen
                    <p class="card-subtitle mb-2 text-light text-muted"><sub>Bekijk en/of bewerk de eigenschappen van <strong><?php echo $data['username'] ?></strong></sub></p>
                </div>

                <div class="card-body">

                    <form method="post">

                        <div class="row">

                            <div class="col">
                                <label for="username" class="form-label">Gebruikersnaam</label>
                                <input type="text" name="username" class="form-control rounded-0 shadow-none" value="<?php echo $data['username'] ?>" aria-label="username">
                            </div>

                            <div class="col">
                                <label for="password" class="form-label">Wachtwoord</label>
                                <input type="password" name="password" class="form-control rounded-0 shadow-none" aria-label="password">
                            </div>

                        </div>

                        <hr class="bg-dark border-secondary border-bottom">

                        <div class="d-grid d-flex gap-2 justify-content-md-end">

							<?php if ($_SESSION['uid'] != $data['id']) { ?>
                                <button type="submit" name="delete_user" class="btn btn-sm btn-danger rounded-0 shadow-none"><i class="bi bi-trash"></i></button>
							<?php } ?>

                            <button type="submit" name="edit_user" class="btn btn-sm btn-primary rounded-0 shadow-none">Opslaan</button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

        <?php if (!is_teacher($data['id'])) { ?>

        <div class="col-sm-5">

            <div class="card rounded-0 mb-3">

                <div class="card-header bg-dark text-light rounded-0">
                    Klasgroep
                    <p class="card-subtitle mb-2 text-light text-muted"><sub>Bekijk en/of bewerk de eigenschappen van de klasgroep van <strong><?php echo $data['username'] ?></strong></sub></p>
                </div>

                <div class="card-body">
					<?php echo '<p class="card-text text-center text-muted">Klik <a href="../group?id=' . $group['id'] . '">hier</a> om <strong>' . $group['name'] . '</strong> te bekijken en/of te bewerken</p>' ?>
                </div>

            </div>

        </div>

        <?php } ?>

    </div>

</div>
