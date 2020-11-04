<?php
/* --------
Filename: inc_users.php
Author: Tracy Johnson
Purpose: This page displays all users and 
allows link to Add User and View Departments
--------  */
?>
<?php 

require('mysqli_connect.php'); // use require because we want to force this to exist before running our queries

$query = "SELECT * FROM USER WHERE user_status='I'";
$result = mysqli_query($connection, $query);

$display = 5;
include('includes/inc_paginationstart.php');
/*
// Determine how many pages
if (isset($_GET['p']) & is_numeric($_GET['p'])) { // Already determined
    $pages = $_GET['p'];
} else { // Need to determine
    
    // Count the number of records
    $query = "SELECT COUNT(user_id) FROM USER WHERE 'user_status' !='I'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result, MYSQLI_NUM);
    $records = $row[0];

    // Calculate the number of pages
    if ($records > $display) { // More than 1 page
        $pages = ceil($records/$display);
    } else {
        $pages = 1;
    }
}

// Determine where in the database to start returning results
if (isset($_GET['s']) & is_numeric($_GET['s'])) {
    $start = $_GET['s'];
} else {
    $start = 0;
}

// Determine the sort 
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sort order
switch ($sort) {
    case 'ln':
        $order_by = 'last_name ASC';
        break;
    case 'fn':
        $order_by = 'first_name ASC';
        break;
    case 'e':
        $order_by = 'email_address ASC';
        break;
    default:
        $order_by = 'last_name ASC';
        break;
}

// Define query
$query = "SELECT first_name, last_name, email_address AS dr, 
    user_id FROM USER 
    WHERE user_status !='I'
    ORDER BY last_name ASC 
    LIMIT $start, $display";
$result = mysqli_query($connection, $query);
*/
?>

<?php 
echo "<button type='button'><a href='register_user.php'><i class='fas fa-user-plus'></i> Add Student</a></button>"; // link to form to add user
echo "<div class='container py-4 rounded'>";
echo "<table class='table table-bordered'>
				<thead>
					<td class='center'>User ID</td>
					<td align='left'><a href='list_users.php?sort=fn'>First Name</a></td>
					<td align='left'><a href='list_users.php?sort=ln'>Last Name</a></td>
					<td align='left'><a href='list_users.php?sort=e'>Email</a></td>
					<td>Modifiy User</td>
				</thead>
				"; // open table and include table headings

while ($row = mysqli_fetch_assoc($result)) {
	$id = $row['user_id'];
	$fn = $row['first_name'];
	$ln = $row['last_name'];
	$e = $row['email_address'];
    $r = $row['role'];

	echo "<tr>
				<td class='center'>
					<button>
						<a href='user_details.php?id=" . $id . "'>" . $id . "</a>
					</button>
				</td>
				<td>" . $fn . "</td>
				<td>" . $ln . "</td>
				<td>" . $e . "</td>";

	if ($r != 'A') {
		echo "<td><button type='button'><a href='edit_user.php?id=" . $id . "'>Edit</a></button>";
	} else {
		echo "<td><button type='button' disabled>Edit</button>";
	}

	echo "<button type='button'><a href='delete_user.php?id=" . $id . "'>Delete</a></button></td>
		</tr>";
}
echo "</div></table>"; // close table

mysqli_close($connection);

?>

<?php include('includes/inc_paginationend.php');

/*
if ($pages >1) {
    echo "<div class='container w-50'>"; // start container

    // determine starting page
    $currentpage = ($start/$display) + 1;

    // if not first page include previous link
    if ($currentpage != 1) {
        echo '<a href="list_users.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Prev</a>';
    } 
    
    // make numbered links
    for ($i = 1; $i <= $pages; $i++) {
        if ($currentpage != 1) {
            echo '<a href="list_users.php?s=' . (($display * ($i -1))) . '&p=' . $pages  . '&sort=' . $sort . '">' . $i . '</a> ';
        } else {
            echo $i . '  ';
        }
    }

    // if not last page include next link
    if ($currentpage != $pages) {
        echo '<a href="list_users.php?s=' . ($start = $display) . '&p=' . $pages  . '&sort=' . $sort . '">Next</a>';
    } 

    echo "<div>"; // close container
}
*/
?>