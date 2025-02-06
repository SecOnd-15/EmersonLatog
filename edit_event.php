<?php
include 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM events WHERE id=$id");
$event = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE events SET title=?, start_date=?, end_date=?, description=? WHERE id=?");
    $stmt->bind_param("ssssi", $title, $start_date, $end_date, $description, $id);
    
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: url('image/pink.png') no-repeat center center fixed;
            background-size: cover;
        }
        .content {
            background: rgba(255, 255, 255, 0.8); /* White overlay for readability */
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <div class="content">
        <h2 class="text-center">Update Event</h2> 
        <form method="POST">
            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($event['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-control" value="<?= $event['start_date']; ?>" required>
            </div>
            <div class="mb-3">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-control" value="<?= $event['end_date']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control"><?= htmlspecialchars($event['description']); ?></textarea>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Update Event</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

</body>
</html>
