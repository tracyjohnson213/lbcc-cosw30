<?php
/* --------
Filename: inc_paginationstart.php
Author: Tracy Johnson
Purpose: Paginate list of results
--------  */
?>
<?php 
require('mysqli_connect.php'); // use require because we want to force this to exist before running our queries

$_GET['p'] = 1;
$_GET['s'] = 1;

$display = 5;

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

?>