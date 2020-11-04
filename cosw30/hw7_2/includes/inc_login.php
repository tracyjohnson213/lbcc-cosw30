<?php
/* --------
Filename: inc_login.php
Author: Tracy Johnson
Purpose: this page lets people login to the site (in theory)
--------  */
?>
<?php 
// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
	$email_address = $_POST['email_address'];
  	$password = $_POST['psw'];

	$problem = false; // No problems so far.
	
	if (empty($email_address)) {
		$problem = true;
		print '<p class="text--error">Please enter your email address!</p>';
	}

	if (empty($password)) {
		$problem = true;
		print '<p class="text--error">Please enter a password!</p>';
	}
	
	if (!$problem & $email_address == 'funnyman@example.com' & $password == '1234') { // If there weren't any problems...

		// Print a message:
		print '<p class="text--success">You are now logged in!<br>Okay, you are not really logged in but...</p>';

		// Clear the posted values:
		$_POST = [];
	
	} else {
	  
	  print '<p class="text--warning">It appears your user or password does not exist.  Please try again or Sign up today!</p>';
	
	}// End of handle form IF.
}

// Create the form:
?>


<form action="login.php" class="form--inline">
	<div class="container w-50">
		<div class="form-row py-2">
			<h3><b>Please log in to confirm how you can help.</b></h3>
		</div>
		
		<div class="form-row py-2">
			<label class="form-label" for="email">Email Address</label>
			<input type="email" name="email" size="20" class="form-control"
					value="<?php if (isset($email_address)) { print htmlspecialchars($email_address); } ?>" required>
		</div>

		<div class="form-row py-2">    
			<label class="form-label" for="psw">Password</label>
			<input type="password" name="psw" class="form-control"
			value="<?php if (isset($password)) { print htmlspecialchars($password); }	?>" required>
		</div>
		
		<div class="form-row py-2">  
			<!--<label class="form-label" for="myCheck"><b>Remember Me</b></label>
			<input type="checkbox" id="myCheck" onclick="rememberMe()" checked>-->       
			<input type="submit" value="Login">
		</div>

		<div class="form-row py-2"> 
			<p class="tester">tester: funnyman@example.com has a password 1234</p>
		</div>
	
	
		<div class="form-row py-2"> 
			<p>Don't have an account? <a href="register_user.php">Sign up!</a>.</p>
		</div>
	</div>
</form>
