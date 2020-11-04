# PHP Crud Basics

This is an educational tutorial and project to demonstrate the creation of a PHP Crud System.  It was inspired by [Long Beach City College](https://www.lbcc.edu/) class COSW 230, PHP and MySQL for Dynamic Web Sites: Visual QuickPro Guide (5th Edition) - Written by Larry Ullman, and [Complete CRUD Operation with PHP MySQL Database](https://youtu.be/JZdMXUIMdQw)
Project URL is <http://tracyj1.sgedu.site/hw7_2/>

## Known issues

1. In prod environment Navbar not displayed correctly
1. Edit User and department produces error
1. Pagination numbers do not appear as links
1. Home page needs styling/decoration
1. Sort appears with legend to id action

## Setup local environment

Download and install [Xampp](https://www.apachefriends.org/download.html)
I am in an Ubuntu environment so I had to run the install with permissions at the root.
`sudo ./xampp-linux-*-installer.run`
Start Apache server - Defaults to port 80
Start MySQL - Defaults to port 3306

- Note: If servers do not start you can check the error logs.  If the ports are already in use, you will need to change the port.
- Note: `sudo /opt/lampp/manager-linux-x64.run` is used to view the **xampp control panel** to configure the ports used by Apache and MySQL

On my system the install defaulted to opt/lampp.
In the htdocs folder add a top level folder to store all your work.  I created cosw230.

## Setup live environment

- I setup an account with [http://www.siteground.com]( http://www.siteground.com)
- My URL is <http://tracyj1.sgedu.site/>

## Setup IDE

Download and install <https://code.visualstudio.com/download>. Any other IDE will work.
I am in an Ubuntu environment so I had to run VS Code with permissions at the root
`chmod 755 xampp-linux-*-installer.run`.

### Create index.html

- I began by creating a new file called index.html to which I added the basic Bootstrap 4 html doc with the Emmet shortcut b4-$. (I previously installed the extension Bootstrap 4, Font awesome 4, Font Awesome 5 Free & Pro snippets for Visual studio code.)
- Update the title, add a H1 with text to the body, and save the file
- In the browser load <http://localhost:80/cosw30/hw7_2/index.html> to view the output from the file.
- Create a file structure for project: folders = css, js, includes, images

- Note: In the browser load <http://localhost:80> to view the xampp dashboard
- Note: In the browser load <http://localhost:81/phpmyadmin/> to view phpadmin
- Note: If the server is not already running execute at the terminal `sudo /opt/lampp/lampp start` or use the xampp control panel

## Create index.php

_As an admin, I want to display a homepage in order to establish a brand and purpose for my site._

- Rename index.html to index.php
- Modify the body to include a h1 text as a placeholder

### Create navbar.php

_As an admin, I want to display navigation links, in order to allow user to easily access pages._

- Copy the head and opening body tag from index.php to includes/navbar.php
- Add the components of a navigation bar
- Replace the original text in the index.php with `<?php $page_title = 'Home Page'; include('includes/navbar.php'); ?>`
- :bug: not working in mobile view

### Create footer.php

_As an admin, I want to display my copyright with the current date, in order to ..._

- Copy the javascript and jquery libraries, closing body and html tags from index.php to includes/footer.php
- Replace the original text in the index.php with `<?php include('includes/footer.php'); ?>`

## Create register_user.php (create user)

_As an admin, I want to display a form, in order to accept inputs reuired to create a new user._
_As a user, I want to access the add user form via the navigation bar, in order to ..._

- Create new file called register_user.php
- Modify the body to include a h1 title and a pointer that will contain the form
`<?php include('includes/inc_register.php'); ?>`
- Update navbar to use link 'Register' pointing to register_user.php

### Basic tasks accomplished in files

1. `require('mysqli_connect.php');` Require a conection to the database (Opens a new connection to the MySQL server)
1. `$query = "SELECT * FROM USER";` Run a query to aquire data
1. `$result = mysqli_query($connection, $query);` Assign the results of the query to a variable (Performs a query against the database)
1. `while ($row = mysqli_fetch_assoc($result)) { echo  $row['user_id']; }` Use the results of each row of data (Fetches a result row as an associative array)
1. `mysqli_close($connection);` Closes an open database connection

## Create inc_register.php

- Create new file includes/inc_register.php
- I began with a copied form from <https://getbootstrap.com/docs/4.5/getting-started/introduction/>.  I then styled the elements using bootstrap classes.
- Above the html is the <?php> code to check if the form has been submitted before validating the fields and displaying errors to the user
- If the inputs validates, the system connects to the database, runs a query, saves the result in a variable, returns the output, and closes the database connection.

```php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    if (empty($first_name)) {
        $problem = true;
        print '<p class="text--error">Please enter your first name!</p>';
    } else {
        $fn = trim($first_name);
    }
    $problem = false;
    if (!$problem) { // If there weren't any problems...
        // register the user in the database
        $query = "INSERT INTO `USER`(`first_name`,`create_date`) VALUES ('$fn', NOW())";
        $result = @mysqli_query($connection, $query); 
        if ($result) { // if query succeeded
            echo "<div class='alert alert-success'>Thank You! You are now registered.</div>";
        } else { // if query failed
            echo "<div class='alert alert-danger'>You could not be registered due to a system error.  Please try again later.</div>";
            echo "<p class='alert'>' . msqli_error($connection) . '<br>Query: ' . $query . '<p>";
        }
        mysqli_close($connection);
        exit();
    }
}
<form action="register_user.php" method="post" class="form--inline">
    <div class="container w-50">
        <div class="form-row py-2">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" size="20" class="form-control" value="<?php if (isset($first_name)) { print htmlspecialchars($first_name); } ?>">
        </div>
    </div>
</form>
```

## Create mysqli_connect.php

- Create new file mysqli_connect.php to establish connection to database
- In place of confirming that database connection is made, I added a SQL query to create the database, tables, and admin users if they do not already exist.

## Create list_users.php and inc_users.php (read users)

- Create new file called list_users.php
- Create new file includes/inc_users.php
- Update navbar to use link 'Users' pointing to list_users.php

```php
$query = "SELECT * FROM USER WHERE user_status='I'";
$result = mysqli_query($connection, $query);
echo "<table class='table table-bordered'>";
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['user_id'];
    $fn = $row['first_name'];
    echo "
    <tr>
        <td class='center'>" . $fn . "</td>";
    echo "
        <td>
            <button type='button'>
                <a href='edit_user.php?id=" . $id . "'>Edit</a>
            </button>
        </td>";
    echo "
    </tr>";
}
echo "</table>";
mysqli_close($connection);
```

## Create user_details.php and inc_user.php (display user details)

- Create new file called user_details.php
- Create new file includes/inc_user.php

```php
$this_user_id = $_GET['id'];
$query = "SELECT * FROM USER WHERE user_id = $this_user_id";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $fn = $row['first_name'];
    $ln = $row['last_name'];
    echo "<i class='fas fa-user'></i>";
    echo "<h1>" . $fn . " " . $ln . "</h1>";
}
mysqli_close($connection);
```

## Create delete_user.php and inc_deleteuser.php (delete user)

- Add delete button for each user in list_users.php
- Create new file called delete_user.php
- Create new file includes/inc_delete.php
- `Status` column is required in the USER table in order to toggle from active to inactive vs removing user from table

```php
if ($_POST['sure'] == 'Yes') { // Delete the record.
    // $query = "DELETE FROM USER WHERE user_id=$id LIMIT 1";
    $query = "UPDATE USER SET user_status = 'I' WHERE user_id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_affected_rows($connection) == 1) { // If it ran OK.
        echo '<p>The user has been deleted.</p>'; // Print a message:
    } else { // If the query did not run OK.
        echo '<p class="error">The user could not be deleted due to a system error.</p>'; // Public message.
        echo '<p>' . mysqli_error($connection) . '<br>Query: ' . $query . '</p>'; // Debugging message.
    }
    mysqli_close($connection);
} else { // No confirmation of deletion.
    echo '<p>The user has NOT been deleted.</p>';
}
```

## **TODO** Create edit_user.php, upload.php and inc_edituser.php (update user)

- Add edit button for each user in list_users.php
- Create new file called edit_user.php
- Create new file includes/inc_edituser.php
- Create new file called upload.php to process file uploads to a uploads directory
- Add uploads directory to folder structure
- Add upload file form to edit_user.php
- Add `profile_image` column to USER table to store name of uploaded file

```php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    if (empty($_POST['first_name'])) {
        $errors[] = 'You forgot to enter your first name.';
    } else {
        $fn = mysqli_real_escape_string($connection, trim($_POST['first_name']));
    }
    if (empty($errors)) { // If everything's OK.
        if (mysqli_num_rows($result) == 0) {
            $query = "UPDATE USER SET first_name=$fn WHERE user_id=$id LIMIT 1";
            $result = mysqli_query($connection, $query);
            if (mysqli_affected_rows($connection) == 1) { // If it ran OK.
                // Print a message:
                echo '<p>The user has been edited.</p>';
            } else { // If it did not run OK.
                echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
                echo '<p>' . mysqli_error($connection) . '<br>Query: ' . $query . '</p>'; // Debugging message.
            }
            mysqli_close($connection);
        } else { // Report the errors.
            echo '<p class="error">The following error(s) occurred:<br>';
            foreach ($errors as $msg) { // Print each error.
                echo " - $msg<br>\n";
            }
            echo '</p><p>Please try again.</p>';
        }
    }
}

$query = "SELECT first_name FROM USER WHERE user_id=$id LIMIT 1";
$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) == 1) { // Valid user ID, show the form.
    // Get the user's information:
    $row = mysqli_fetch_array($result, MYSQLI_NUM);
    // Create the form:
    echo '
    <form action="edit_user.php" method="post" class="form--inline">
        <div class="container w-50">
            <div class="form-row py-2">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" name="first_name" size="50" class="form-control" value="' . $row[0] . '">
            </div>
        </div>
    </form>';
}
```

### Create list_department.php and inc_departments.php (read departments)

- Create new file called list_department.php
- Create new file includes/inc_departments.php
- Update navbar to use link 'Departments' pointing to list_department.php

### Create add_department.php and inc_adddepartment.php (create department)

- Create new file called add_department.php
- Create new file includes/inc_adddepartment.php

### Create edit_department.php and inc_editdepartment.php (update department)

- Create new file called edit_department.php
- Create new file includes/inc_editdepartment.php

### Create delete_department.php and inc_deletedepartment.php (read department)

- Create new file called delete_department.php
- Create new file includes/inc_deletedepartment.php

### Create login.php

- Create new file called login.php
- Modify the body to use includes for navbar, footer and `<?php include('includes/inc_login.php'); ?>`
- Update navbar to use link 'Login' pointing to login.php

### Paginate and sort list_users.php

- Update list_users.php with newly created includes/inc_paginationstart.php and inc_paginationend.php

### Create functions.php

- Create functions in includes/functions.php
