<?php
/* --------
Filename: mysqli_connect.php
Author: Tracy Johnson
--------  */
?>
<?php

/*//Connect to local database 
$host = "localhost"; // My website hosting for those using my cpanel, if you are using your own, just use 127.0.0.1 to indicate your local host
$user = "root"; //Your database username Does not change
$pass = ""; // Your database user password
$db = "school"; //Your database name you want to connect to 
$port = 3307; //The port #. It is always 3306
*/

//--- Connect to the siteground 
$host = "localhost"; // My website hosting for those using my cpanel, if you are using your own, just use 127.0.0.1 to indicate your local host
$user = "uj8rdhmdrfemd"; //Your database username Does not change
$pass = "rsek46eg2crk"; // Your database user password
$db = "dbn8btarx5vcn5"; //Your database name you want to connect to 
$port = 3306; //The port #. It is always 3306


// Try to make a database connection
$connection = mysqli_connect($host, $user, $pass, $db, $port); // Catch any connection errors
if(mysqli_connect_errno()) {
die("Database connection failed: " .
mysqli_connect_error() .
" (" .mysqli_connect_errno() . ")"
);
} else {

    // echo "connection made";
    // create table if does not exist
    /*
    $sql = "CREATE DATABASE IF NOT EXISTS " .$db;

    if(mysqli_query($connection,$sql)) {
        $connection = mysqli_connect($host, $user, $pass, $db, $port);
    } else {
        echo "Error creating database " . mysql_error($connection);
    }

    // create table if does not exist
    $sql = "CREATE TABLE IF NOT EXISTS `USER` (
        user_id INT(11) AUTO_INCREMENT PRIMARY KEY,
        email_address VARCHAR(50) NOT NULL,
        password1 VARCHAR(50) NOT NULL,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        create_date TIMESTAMP,
        last_login TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        user_status VARCHAR(1) DEFAULT 'S',
        profile_image VARCHAR(80) DEFAULT 'defaultavatarprofileicon.jpg'
    )";

    $sql = "CREATE TABLE IF NOT EXISTS `DEPARTMENT` (
        department_id INT(11) AUTO_INCREMENT PRIMARY KEY,
        department_name VARCHAR(50) NOT NULL,
        num_of_employees VARCHAR(50) NOT NULL,
        department_status VARCHAR(1) DEFAULT 'A'
    )";

    // create users if do not exist
    $sql = "INSERT INTO `USER`(`email_address`, `psw`, `first_name`, `last_name`, `role`, `profile_image`) 
    SELECT * FROM (SELECT 'tracyjohnson213@gmail.com', 'Abc1234!','Tracy','Johnson','A', `tracyjphoto-min.png`)
    AS tmp
    WHERE NOT EXISTS (SELECT `email_address` FROM `USER` WHERE `first_name` = `Tracy`) LIMIT 1";
    
    $sql = "INSERT INTO `USER`(`email_address`, `psw`, `first_name`, `last_name`, `role`) 
    SELECT * FROM (SELECT 'funnyman@example.com', '1234','Funny','Man','S')
    AS tmp
    WHERE NOT EXISTS (SELECT `email_address` FROM `USER` WHERE `first_name` = `Funny`) LIMIT 1";
    
    if(mysqli_query($connection,$sql)) {
        $connection = mysqli_connect($host, $user, $pass, $db, $port);
    } else {
        echo "Error creating table " . mysql_error($connection);
    }*/

}

// If no errors, you can proceed with your sql queries

?>
