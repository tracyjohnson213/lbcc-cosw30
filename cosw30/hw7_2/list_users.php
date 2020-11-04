<html>
<head>
<?php
/* --------
Filename: list_users.php
Author: Tracy Johnson
--------  */
?>
<?php $page_title = 'List Users';
include('includes/navbar.php'); 
?>

<div class="container text-center justify-content-center">
      <h1 class="py-4 bg-dark text-light rounded">List of Students</h1>
      <?php include('includes/inc_users.php'); ?>
	</div>

<?php include('includes/footer.php'); ?>