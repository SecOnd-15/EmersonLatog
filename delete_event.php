<?php
include 'db.php';

$id = $_GET['id'];

if ($conn->query("DELETE FROM events WHERE id=$id")) {
    header("Location: index.php");
} else {
    echo "Error deleting event: " . $conn->error;
}
?>
