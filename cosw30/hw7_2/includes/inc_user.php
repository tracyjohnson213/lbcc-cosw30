<?php
/* --------
Filename: inc_user.php
Author: Tracy Johnson
Purpose: To present details of single user
--------  */
?>
<?php 
require('mysqli_connect.php'); // use require because we want to force this to exist before running our queries

$this_user_id = $_GET['id'];
//And now to perform a simple query to make sure it's working
$query = "SELECT * FROM USER WHERE user_id = $this_user_id";
$result = mysqli_query($connection, $query);

echo "<div class='container w-50'>";
while ($row = mysqli_fetch_assoc($result)) {

    $id = $row['user_id'];
	$fn = $row['first_name'];
	$ln = $row['last_name'];
	$e = $row['email_address'];
    $r = $row['role'];
    $img = $row['profile_image'];
    
    echo "<i class='fas fa-user'></i>";
    echo "<h1>" . $fn . " " . $ln . "</h1>";
    echo "<p><img style='width: 30%;' class='profile' src='uploads/" . $img ." alt='. $img .'></p>";
    echo "<p>Employee ID: ". $id . "</p>";
    if ($r == 'S') {
        echo "<p>Employee Role: Student</p>";
    } else {
        echo "<p>Employee Role: Admin</p>";
    }
    echo "<p>Email Address: ". $e. "</p>";
}

echo "<button type='button'>
        <a href='list_users.php'><i class='fas fa-users'></i> Return to User List</a>
    </button>";
    echo "</div>";


?>