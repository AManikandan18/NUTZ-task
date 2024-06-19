<?php
$servername = "localhost:8080";  // Replace with your server name
$username = "root";     // Replace with your database username
$password = "";             // Replace with your database password
$dbname = "electricity_billing_system";  // Replace with your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully";
}
?>
