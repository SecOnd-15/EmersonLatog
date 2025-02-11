<?php
include 'db.php';


if (!isset($_COOKIE['user_id'])) {
    header("Location: login.php");
    exit();
}


if (!isset($_GET['id'])) {
    die("Event ID is missing.");
}

$id = $_GET['id'];


$sql = "DELETE FROM events WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit();
} else {
    die("Error deleting event: " . $conn->error);
}
?>