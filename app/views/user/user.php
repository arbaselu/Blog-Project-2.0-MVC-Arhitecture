<?php
if (!isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] !== true) {
    header("Location: /login");
    die; 
}
?>

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
    <link rel="stylesheet" href="/public/assets/css/user.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
    
</head>
<script defer src="/public/assets/js/functions.js"></script>
<body>

<header>
    <?php require_once 'app/views/navbar/index.php'; ?>
</header>

    <div class="page-content">
            <h1>Hello <?php echo $_SESSION['fullName']."!" ?></h1>
        <div class="main-container">
<?php 
                if(isset($_SESSION['role_user']) && $_SESSION['role_user'] === 'admin') {   
            echo  '<div class="posts-settings">
        <a href="AddPost" ><button class="btn-add">
            Add article
        </button></a>
        
        <a href="search.php" ><button class="btn-search">
            Search a post for edit
        </button></a>
        </div>
            <div class="container-swap-video">
            
              <h4>Add that latest video to your home page</h4>
                <form class="form-swap" action="updateVideo.php" method="POST" >
                <input type="text" name="new_video_link" placeholder="Link Video" required>
                <button type="submit" class="submit_button">Swap video</button>
                </form>
       
    </div>';
     
}

?>
        <div class="account-settings">
        <a href="" ><button class="btn-reset">
            Reset Password
        </button></a>
        
        <a href="user/logout" ><button class="btn-logout">
            Logout
        </button></a>
        </div>
              
</div>
</div>

</body>
</html>
