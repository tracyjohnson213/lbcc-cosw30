<html>
<head>
<?php
/* --------
Filename: list_departments.php
Author: Tracy Johnson
--------  */
?>
<?php $page_title = 'List Departments';
include('includes/navbar.php'); 
?>

<div class="container text-center justify-content-center">
      <h1 class="py-4 bg-dark text-light rounded">List of Departments</h1>
      <?php include('includes/inc_departments.php'); ?>
	</div>


<?php include('includes/footer.php'); ?>