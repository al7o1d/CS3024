<<<<<<< HEAD
Software_Engineering
====================

Software engineering team project
=======
CS3024
======
1. Clone the repository into your folder
2. Create a DbConn.php file with the contents:
<?php
$servername = "localhost";
$username = "username"; //replace with your phpmyadmin/mysql username
$password = "password"; //replace with your phpmyadmin/mysql password
$dbname = "education"; //replace with the name for your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
3. Work!!!
>>>>>>> d21fea9f1f276923fe9e8d25dc551e62510345f3
