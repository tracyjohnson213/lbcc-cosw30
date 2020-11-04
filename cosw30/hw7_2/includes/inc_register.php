<?php
/* --------
Filename: inc_register.php
Author: Tracy Johnson
Purpose: To present form to allow new user to be added to database
--------  */
?>
<?php // - inc_register.php
require('mysqli_connect.php'); // connect to database

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email_address = $_POST['email_address'];
	$password1 = $_POST['psw'];
	$password2 = $_POST['psw-repeat'];

	$problem = false; // No problems so far.
	
	// Check for each value...
	if (empty($first_name)) {
		$problem = true;
		print '<p class="text--error">Please enter your first name!</p>';
	} else {
	    $fn = trim($first_name);
	}
	
	if (empty($last_name)) {
		$problem = true;
		print '<p class="text--error">Please enter your last name!</p>';
	} else {
	    $ln = trim($last_name);
	}

	if (empty($email_address)) {
		$problem = true;
		print '<p class="text--error">Please enter your email address!</p>';
	} else {
	    $e = trim($email_address);
	}

	if (empty($password1)) {
		$problem = true;
		print '<p class="text--error">Please enter a password!</p>';
	} elseif ($password1 != $password2) {
		$problem = true;
		print '<p class="text--error">Your password did not match your confirmed password!</p>';
	} else {
	    $pw = trim($password1);
	}
	

	if (!$problem) { // If there weren't any problems...
	    // register the user in the database
		
		$query = "INSERT INTO `USER`(`email_address`, `psw`, `first_name`, `last_name`, `create_date`) 
							   VALUES ('$e', '$pw', '$fn', '$ln', NOW())"; // create query
		
		$result = @mysqli_query($connection, $query); // run query
		
        if ($result) { // if query succeeded
		    echo "<div class='alert alert-success'>Thank You! You are now registered.</div>";
        } else { // if query failed
            echo "<div class='alert alert-danger'>You could not be registered due to a system error.  Please try again later.</div>";
            echo "<p class='alert'>' . msqli_error($connection) . '<br>Query: ' . $query . '<p>";
        }
        
        // mysqli_close($connection);
        
        include('includes/footer.php');
        exit();

	}  

} // End of handle form IF.


// Create the form:
?>
<form action="register_user.php" method="post" class="form--inline">
	<div class="container w-50">
		<div class="row py-2">
	    	<h3><b>Please fill in this form to create an account.</b></h3>
    	</div>
    
    	<div class="form-row py-2">
    		<label for="first_name" class="form-label">First Name</label>
  			<input type="text" name="first_name" size="20" class="form-control"
  			value="<?php if (isset($first_name)) { print htmlspecialchars($first_name); } ?>">
		</div>
    
		<div class="form-row py-2">
				<label for="last_name" class="form-label">Last Name</label>
				<input type="text" name="last_name" size="20" class="form-control"
				value="<?php if (isset($last_name)) { print htmlspecialchars($last_name); } ?>"></p>
		</div>
    
		<div class="form-row py-2">
				<label for="email_address" class="form-label">Email Address</label>
				<input type="email" name="email_address" size="20" class="form-control"
				value="<?php if (isset($email_address)) { print htmlspecialchars($email_address); } ?>"></p>
		</div>
    
		<div class="form-row py-2">
				<label for="psw" class="form-label">Password</label>
				<input type="password" name="psw" size="20" class="form-control"
				pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" 
    		title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" 
				value="<?php if (isset($password1)) { print htmlspecialchars($password1); }?>">
		</div>
    
		<div class="row py-2">
				<label for="psw-repeat" class="form-label">Confirm Password</label>
				<input type="password" name="psw-repeat" size="20" class="form-control"
				value="<?php if (isset($password2)) { print htmlspecialchars($password2); } ?>">
		</div>
    
		<div class="row py-2">
			<div class="col">
				<input type="submit" name="submit" value="Register!" class="button--pill">
			</div>
			<div class="col">
			<p>Already have an account? <a href="login.php">Sign in</a>.</p>
		</div>
	  </div>
	  </div>

</form>
