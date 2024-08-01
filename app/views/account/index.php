
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mario's Blog</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Proxima+Nova:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/public/assets/css/navbar.css">
    <link rel="stylesheet" href="/public/assets/css/account.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<script defer src="/public/assets/js/functions.js"></script>
<body>
<?php include 'app/views/navbar/index.php'; ?>

    <main>
        <div class="main-content">
            <div class="page-content">
                <h1>Login/Register</h1>
                <div class="buttons-account">
                    <a href="/login"><button class="btn-login">Login</button></a>
                    <a href="/register"><button class="btn-register">Register</button></a>
                </div>
            </div>
    </div>
    </main>

</body>
</html>