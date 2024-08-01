
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($data['posts']['post_title']); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Proxima+Nova:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/assets/css/post.css">
</head>
<script defer src="/public/assets/js/functions.js"></script>
<body>
<article class="article">
        <div class="titlu">
            <?php echo htmlspecialchars($data['posts']['post_title']); ?>
        </div>
        <div class="post_autor">
            <h4>Autor articol: <?php echo htmlspecialchars($data['posts']['full_name']); ?></h4>
        </div>
        <hr>
        <img src="/public/assets/images/home.office.svg" alt="Image related to the post">
        
        <div class="continut">
            <?php echo nl2br(htmlspecialchars($data['posts']['post_content'])); ?>
          
        </div>
         <hr>
     <div class="container-buttons">
        <div class="edit-button">
            <?php 
                if(isset($_SESSION['role_user']) && $_SESSION['role_user'] === 'admin') {
                    echo '<a href ="/EditPost/' . htmlspecialchars($data['posts']['slug']) . '">Edit</a>';
                    echo '<a href ="/DeletePost/index/' . htmlspecialchars($data['posts']['slug']) . '">Delete</a>';
                }

            ?>
        </div>
        </div>
      
    </article>

</body>
</html>