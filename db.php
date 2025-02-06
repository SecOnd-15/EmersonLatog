<?php
$host = "localhost";
$user = "root"; // Change this to your MySQL username
$pass = ""; // Change this to your MySQL password
$dbname = "event_calendar";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

