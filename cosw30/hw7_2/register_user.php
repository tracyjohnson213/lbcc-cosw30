<!DOCTYPE html>
<?php
/* --------
Filename: index.php
Author: Tracy Johnson
Purpose: This is where all the magic starts!
--------  */
?>
<?php $page_title = 'Home Page';
include('includes/navbar.php'); 
?>

    <div class="container text-center justify-content-center">
      <h1 class="py-4 bg-dark text-light rounded">New Students</h1>
      <?php include('includes/inc_register.php'); ?>
	</div>
	
	<?php include('includes/footer.php'); ?>