<?php
include 'db.php';

// Fetch events sorted by start date
$result = $conn->query("SELECT * FROM events ORDER BY start_date ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Calendar</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <style>
        body {
            background: url('image/cutie.png') no-repeat center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 900px;
        }

        .content {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .header {
            background: rgb(255, 0, 140);
            color: white;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }

        .btn-custom {
            padding: 10px 15px;
            font-size: 16px;
            font-weight: bold;
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .btn-sm {
            font-size: 14px;
            padding: 6px 12px;
        }

        @media (max-width: 576px) {
            .content {
                padding: 15px;
            }
            .btn {
                font-size: 14px;
            }
            th, td {
                font-size: 14px;
            }
        }
    </style>
</head>
<body class="container mt-4">

    <div class="content">
        <h2 class="header">📅 Calendar Events 📅</h2>

        <div class="d-flex justify-content-center my-3">
            <a href="add_event.php" class="btn btn-success btn-custom">➕ Add Event</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Title</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Description</th>
                        <th>ActionsActionsActionsActionsActions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?= htmlspecialchars($row['title']); ?></td>
                            <td><?= htmlspecialchars($row['start_date']); ?></td>
                            <td><?= htmlspecialchars($row['end_date']); ?></td>
                            <td><?= htmlspecialchars($row['description']); ?></td>
                            <td class="text-nowrap text-center">
                                <a href="edit_event.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">✏️ Edit</a>
                                <a href="delete_event.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Are you sure you want to delete this event?');">🗑️ Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
