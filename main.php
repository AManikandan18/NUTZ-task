<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['usertype'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
$meter_no = $_SESSION['meter_no'];

echo "<h1>Welcome, $username</h1>";
echo "<p>You are logged in as $usertype with meter number $meter_no.</p>";
?>
