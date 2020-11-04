<?php
/* --------
Filename: inc_deletedepartment.php
Author: Tracy Johnson
Purpose: To set department status to Inactive
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
	// include('includes/footer.html');
	exit();
}

require('mysqli_connect.php');

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($_POST['sure'] == 'Yes') { // Delete the record.

		// Make the query:
		// $query = "DELETE FROM USER WHERE user_id=$id LIMIT 1";
        $query = "UPDATE DEPARTMENT SET department_status = 'I' WHERE department_id=$id";
		$result = @mysqli_query($connection, $query);
		if (mysqli_affected_rows($connection) == 1) { // If it ran OK.

			// Print a message:
			echo '<p>The department has been deleted.</p>';

		} else { // If the query did not run OK.
			echo '<p class="error">The department could not be deleted due to a system error.</p>'; // Public message.
			echo '<p>' . mysqli_error($connection) . '<br>Query: ' . $query . '</p>'; // Debugging message.
		}

	} else { // No confirmation of deletion.
		echo '<p>The department has NOT been deleted.</p>';
	}

} else { // Show the form.
// Retrieve the user's information:
	$query = "SELECT department_id FROM DEPARTMENT WHERE department_id=$id";
	$result = @mysqli_query($connection, $query);

	if (mysqli_num_rows($result) == 1) { // Valid department ID, show the form.

		// Get the user's information:
		$row = mysqli_fetch_array($result, MYSQLI_NUM);

		// Display the record being deleted:
		echo "<h3>Department: $row[0]</h3>
		Are you sure you want to delete this department?";

		// Create the form:
		echo '<form action="delete_department.php" method="post">
	<input type="radio" name="sure" value="Yes"> Yes
	<input type="radio" name="sure" value="No" checked="checked"> No
	<input type="submit" name="submit" value="Submit">
	<input type="hidden" name="id" value="' . $id . '">
	</form>';

	} else { // Not a valid department ID.
		echo '<p class="error">This page has been accessed in error.</p>';
	}

} // End of the main submission conditional.

mysqli_close($connection);
?>