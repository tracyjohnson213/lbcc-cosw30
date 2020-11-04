<?php
/* --------
Filename: inc_edituser.php
Author: Tracy Johnson
Purpose: To present form to allow update existing user in database
--------  */
?>
<?php

// Check for a valid user ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
	include('includes/footer.php');
	exit();
}

require('mysqli_connect.php');

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email_address = $_POST['email_address'];

	$errors = [];

	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($connection, trim($_POST['first_name']));
	}

	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($connection, trim($_POST['last_name']));
	}

	// Check for an email address:
	if (empty($_POST['email_address'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($connection, trim($_POST['email_address']));
	}

	if (empty($errors)) { // If everything's OK.
		//  Test for unique email address:
		$query = "SELECT user_id FROM USER WHERE email_address='$e' AND user_id!=$this_user_id";
		$result = @mysqli_query($connection, $query);
		if (mysqli_num_rows($result) == 0) {

			// Make the query:
			$query = "UPDATE USER SET first_name='$fn', last_name='$ln', email_address='$e' WHERE usesr_id=$id LIMIT 1";
			$result = mysqli_query($connection, $query);
			if (mysqli_affected_rows($connection) == 1) { // If it ran OK.

				// Print a message:
				echo '<p>The user has been edited.</p>';

			} else { // If it did not run OK.
				echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($connection) . '<br>Query: ' . $query . '</p>'; // Debugging message.
			}

		} else { // Already registered.
			echo '<p class="error">The email address has already been registered.</p>';
		}

	} else { // Report the errors.

		echo '<p class="error">The following error(s) occurred:<br>';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br>\n";
		}
		echo '</p><p>Please try again.</p>';

	} // End of if (empty($errors)) IF.

} // End of submit conditional.

// Always show the form...

// Retrieve the user's information:
$query = "SELECT first_name, last_name, email_address,'role',profile_image FROM USER WHERE user_id=$id LIMIT 1";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) == 1) { // Valid user ID, show the form.

	// Get the user's information:
	$row = mysqli_fetch_array($result, MYSQLI_NUM);

	// Create the form:
	echo '
		<form action="edit_user.php" method="post" class="form--inline">
			<div class="container w-50">
			
			<div class="form-row py-2">
				<label for="first_name" class="form-label">First Name</label>
				<input type="text" name="first_name" size="50" class="form-control"
				value="' . $row[0] . '">
			</div>

			<div class="form-row py-2">
				<label for="last_name" class="form-label">Last Name</label>
				<input type="text" name="last_name" size="50" class="form-control"
				value="' . $row[1] . '">
			</div>
		
			<div class="form-row py-2">
					<label for="email_address" class="form-label">Email Address</label>
					<input type="email" name="email_address" size="50" class="form-control"
					value="' . $row[2] . '">
			</div>

			<div class="form-row py-2">
					<label for="role" class="form-label">Role</label>
					<input type="text" name="role" size="1" class="form-control"
					value="' . $row[3] . '">
			</div>
		
		<form action="upload.php" method="post" enctype="multipart/form-data" class="form--inline">
			<div class="form-row py-2">
				<label for="fileToUpload" class="form-label">Select image to upload:</label>
				<input type="file" name="fileToUpload" class="form-control" id="fileToUpload">
				<input type="submit" value="Upload Image" name="submit" class="button--pill">
			</div>
		</form>
			
		<div class="form-row py-2">
			<div class="col">
				<input type="submit" name="submit" value="Save" class="button--pill">
			</div>
		</div>
	</form>

	<img style="width: 30%;" class="profile" name="profile_image" src="uploads/' . $row[4] .'">
  			';

} else { // Not a valid user ID.
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($connection);

?>