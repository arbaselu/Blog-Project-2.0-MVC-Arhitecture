<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Proxima+Nova:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/assets/css/register.css">
</head>
<script defer src="/public/assets/js/functions.js"></script>
<body>
    <div class="form-container">
      <p class="title">Create account</p>
      <form action="/register" method="POST" class="form">
        <input type="text" name="full_name" class="input" placeholder="Full Name" value="<?php echo isset($_SESSION['input_full_name']) ? $_SESSION['input_full_name'] : ''; ?>">
        <p class="error"><?php echo isset($_SESSION['fullNameError']) ? $_SESSION['fullNameError'] : ''; ?></p>

        <input type="email" name="email" class="input" placeholder="Email" required value="<?php echo isset($_SESSION['input_email']) ? $_SESSION['input_email'] : ''; ?>">
        <p class="error"><?php echo isset($_SESSION['emailError']) ? $_SESSION['emailError'] : ''; ?></p>

        <input type="text" name="username" class="input" placeholder="Username" value="<?php echo isset($_SESSION['input_username']) ? $_SESSION['input_username'] : ''; ?>">
        <p class="error"><?php echo isset($_SESSION['usernameError']) ? $_SESSION['usernameError'] : ''; ?></p>

        <input type="password" name="password" class="input" placeholder="Password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
        <p class="error"><?php echo isset($_SESSION['passwordError']) ? $_SESSION['passwordError'] : ''; ?></p>

        <input type="password" name="confirmPassword" class="input" placeholder="Confirm Password">
        <p class="error"><?php echo isset($_SESSION['confirmPasswordError']) ? $_SESSION['confirmPasswordError'] : ''; ?></p>

        <button type="submit" name="submit-register" class="form-btn">Create account</button>
      </form>
      <p class="sign-up-label">
        Already have an account? <a href="/login" class="sign-up-link">Log in</a>
      </p>
    </div>
</body>
</html>
