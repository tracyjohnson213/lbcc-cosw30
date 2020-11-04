<?php
/* --------
Filename: inc_departments.php
Author: Tracy Johnson
Purpose: This page displays all departments
--------  */
?>
<?php 
require('mysqli_connect.php'); // use require because we want to force this to exist before running our queries

//And now to perform a simple query to make sure it's working
$query = "SELECT * FROM DEPARTMENT WHERE department_status != 'I' ORDER BY department_name ";
$result = mysqli_query($connection, $query);

echo "<button type='button'><a href='add_department.php'><i class='fas fa-user-plus'></i> Add Department</a></button>"; // link to form to add user
echo "<div class='container w-50'>";
echo "<table class='table table-bordered'>
				<thead>
					<td class='center'>ID</td>
					<td>Department Name</td>
					<td># of Emp</td>
					<td>Bldg Location</td>
					<td>Modify Dept</td>
				</thead>
				"; // open table and include table headings

while ($row = mysqli_fetch_assoc($result)) {
echo "<tr>
				<td>" . $row['department_id'] . "</td>
				<td>" . $row['department_name'] . "</td>
				<td>" . $row['num_of_employees'] . "</td>
				<td>" . $row['building_number'] . "</td>
				<td><button type='button'><a href='edit_department.php?id=" . $row['department_id'] . "'>Edit</a></button>
				<button type='button'><a href='delete_department.php?id=" . $row['department_id'] . "'>Delete</a></button></td>
			</tr>";
}
echo "</table>"; // close table

?>