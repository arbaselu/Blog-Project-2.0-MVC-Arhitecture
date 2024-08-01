<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Proxima+Nova:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/assets/css/login.css">
</head>
<script defer src="/public/assets/js/functions.js"></script>
<body>
    <div class="form-container">
        <h1 class="title">Welcome back</h1>
        <form action="/login" method="POST" class="form">
            <input type="text" name="username" class="input" placeholder="Username" value="<?php echo isset($_SESSION['input_username']) ? $_SESSION['input_username'] : ''; ?>">
            <p class="error"><?php echo isset($_SESSION['usernameError']) ? $_SESSION['usernameError'] : ''; ?></p>
            <input type="password" name="password" class="input" placeholder="Password">
            <p class="error"><?php echo isset($_SESSION['passwordError']) ? $_SESSION['passwordError'] : ''; ?></p>
            <p class="page-link">
                <a href="/resetPassword" class="page-link-label">Forgot Password?</a>
            </p> 
            <button type="submit" name="submit-login" class="form-btn">Log in</button>
        </form>
        <p class="sign-up-label">
            Don't have an account? <a href="/register" class="sign-up-link">Sign up</a>
        </p>
    </div>
</body>
</html>
