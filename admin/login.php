<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background:linear-gradient(to bottom, red, orange);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 10px 10px 15px 10px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>
<div class="login-box">
    <h2 class="text-center mb-4">Admin Login</h2>
    <form method="POST" action="auth.php">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
        </div>
        <div class="d-grid">
            <button type="submit" name="login" class="btn btn-primary ">
                Login Now
            </button>
        </div>
    </form>
    </div>
</body>
</html>