<?php
/* --------
Filename: inc_adddepartments.php
Author: Tracy Johnson
Purpose: This page displays all departments with add row of inputs
--------  */
?>

<?php
// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$problem = false; // No problems so far.
	
	// Check for each value...
	if (empty($_POST['department_name'])) {
		$problem = true;
		print '<p class="text--error">Please enter your department name!</p>';
	} else {
	    $d = trim($_POST['department_name']);
	}
	
	if (empty($_POST['building_number'])) {
		$problem = true;
		print '<p class="text--error">Please enter your building location!</p>';
	} else {
	    $b = trim($_POST['building_number']);
    }
    
    if ($_POST['num_of_employees']) {
        $n = trim($_POST['num_of_employees']);
    }
	

	if (!$problem) { // If there weren't any problems...
	    // register the user in the database

		require('mysqli_connect.php'); // connect to database
		
		$query = "INSERT INTO `DEPARTMENT`(`department_name`, `num_of_employees`, `building_number`) 
							   VALUES ('$d', '$b', '$n')"; // create query
		
		$result = @mysqli_query($connection, $query); // run query
		
        if ($result) { // if query succeeded
		    echo "<div class='alert alert-success'>Thank You! Your new department has been added.</div>";
        } else { // if query failed
            echo "<div class='alert alert-danger'>Your department could not added due to a system error.  Please try again later.</div>";
            echo "<p class='alert'>' . msqli_error($connection) . '<br>Query: ' . $query . '<p>";
        }
        
        // mysqli_close($connection);
        
        include('includes/footer.php');
        exit();

	}  

} // End of handle form IF.
?>

<form action="add_department.php" method="post" class="form--inline">
	<div class="container w-50">
		<div class="row py-2">
	    	<h3><b>Please fill in this form to a department.</b></h3>
    	</div>
    
    	<div class="form-row py-2">
    		<label for="department_name" class="form-label">Department</label>
  			<input type="text" name="department_name" size="50" class="form-control"
  			value="<?php if (isset($_POST['department_name'])) { print htmlspecialchars($_POST['department_name']); } ?>">
        </div>

        <div class="form-row py-2">
    		<label for="num_of_employees" class="form-label">Number of Employees</label>
  			<input type="text" name="num_of_employees" size="50" class="form-control"
  			value="<?php if (isset($_POST['num_of_employees'])) { print htmlspecialchars($_POST['num_of_employees']); } ?>">
        </div>

        <div class="form-row py-2">
    		<label for="building_number" class="form-label">Location</label>
  			<input type="text" name="building_number" size="5" class="form-control"
  			value="<?php if (isset($_POST['building_number'])) { print htmlspecialchars($_POST['building_number']); } ?>">
        </div>

        <div class="row py-2">
			<input type="submit" name="submit" value="Add!" class="button--pill">
		</div>
    </div>
</form>



