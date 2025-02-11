<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error = "Username already taken. Please choose another one.";
    } else {
       
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ? )");
        // Corrected line to match the number of columns
        $stmt->bind_param("ss", $username, $hashed_password); 

        if ($stmt->execute()) {
            
            $success = "Registration successful! You can now log in.";
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: url('image/cutie.png') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        .content {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
            margin-top: 50px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .btn-custom {
            padding: 10px 15px;
            font-size: 16px;
            font-weight: bold;
            width: 150px; 
        }
        .social-icons a {
            font-size: 20px;
            color: #fff;
            margin: 5px;
            text-decoration: none;
        }
        .social-icons a:hover {
            color: #ddd;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="content">
            <h2 class="text-center">Register</h2>
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger"><?= $error; ?></div>
            <?php endif; ?>
            <?php if (isset($success)) : ?>
                <div class="alert alert-success">
                    <?= $success; ?>
                    <br>
                    <a href="login.php" class="btn btn-dark btn-custom mt-3">Go to Login</a>
                </div>

      
                <script type="text/javascript">
                    alert("Registration successful! You can now log in.");
                    window.location.href = "login.php"; 
                </script>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-dark btn-custom">Register</button>
                    <a href="login.php" class="btn btn-dark btn-custom">Login</a>
                </div>
            </form>

       
            <div class="text-center mt-3 social-icons">
                <a href="https://www.facebook.com" target="_blank" class="btn btn-primary"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com" target="_blank" class="btn btn-danger"><i class="fab fa-instagram"></i></a>
                <a href="https://web.telegram.org" target="_blank" class="btn btn-info"><i class="fab fa-telegram"></i></a>
                <a href="https://www.google.com" target="_blank" class="btn btn-light"><i class="fab fa-google"></i></a>
            </div>
        </div>
    </div>
</body>
</html>
