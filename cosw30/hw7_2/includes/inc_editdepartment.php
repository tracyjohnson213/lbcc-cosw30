
<?php
/* --------
Filename: inc_editdepartment.php
Author: Tracy Johnson
Purpose: To present form to allow update existing department in database
--------  */
?>
<?php

// Check for a valid department ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From department.php
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

	$errors = [];

	// Check for a first name:
	if (empty($_POST['department_name'])) {
		$errors[] = 'You forgot to enter your department name.';
	} else {
		$d = mysqli_real_escape_string($connection, trim($_POST['department_name']));
	}

	// Check for a last name:
	if (empty($_POST['building_number'])) {
		$errors[] = 'You forgot to enter your location.';
	} else {
		$b = mysqli_real_escape_string($connection, trim($_POST['building_number']));
	}

	// Check for an email address:
	if ($_POST['num_of_employees']) {
		$n = mysqli_real_escape_string($connection, trim($_POST['num_of_employees']));
	}

} // End of submit conditional.

// Always show the form...

// Retrieve the user's information:
$query = "SELECT department_name, building_number, num_of_employees FROM DEPARTMENT WHERE department_id=$id LIMIT 1";
$result = @mysqli_query($connection, $query);

if (mysqli_num_rows($result) == 1) { // Valid user ID, show the form.

	// Get the user's information:
	$row = mysqli_fetch_array($result, MYSQLI_NUM);

	// Create the form:
	echo '
		<form action="edit_department.php" method="post" class="form--inline">
			<div class="container w-50">
			
			<div class="form-row py-2">
				<label for="department_name" class="form-label">Department</label>
				<input type="text" name="department_name" size="50" class="form-control"
				value="' . $row[0] . '">
			</div>

			<div class="form-row py-2">
				<label for="building_number" class="form-label">Location</label>
				<input type="text" name="building_number" size="5" class="form-control"
				value="' . $row[1] . '">
		</div>
    
		<div class="form-row py-2">
				<label for="num_of_employees" class="form-label">Number of employees</label>
				<input type="text" name="num_of_employees" size="5" class="form-control"
				value="' . $row[2] . '">
		</div>
			
		<div class="form-row py-2">
			<div class="col">
				<input type="submit" name="submit" value="Save" class="button--pill">
			</div>
		</div>
	</form>
';

} else { // Not a valid user ID.
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($connection);

?>