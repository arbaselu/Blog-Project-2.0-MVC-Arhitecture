
<!DOCTYPE html>
<html lang='ro'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mario's Blog</title>
    <link rel="stylesheet" href="Style/blogStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Proxima+Nova:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/assets/css/navbar.css">
    <link rel="stylesheet" href="/public/assets/css/blog.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<script defer src="/public/assets/js/functions.js"></script>
<body>

<?php include 'app/views/navbar/index.php'; ?>

    <main>
        <div class="main-content">
        <div class="blog-articles">

<?php
    foreach($data['posts'] as $post){
        echo '<div class="article">
            <a href ="blog/'.$post['slug'].'"><h2>'.$post['post_title'].'</h2></a><br>
            <img src="/public/assets/Images/background.jpg" alt="human-robot">
            <p>'.mb_strimwidth($post['post_content'],0,250,"...").'</p>
            <a href ="blog/' .$post['slug']. '"<button class="read-button">Citeste mai departe...</button></a>
            </div>';
}
?>
    </div>
    </div>
    </main>
    
    <?php include 'app/views/footer/index.php'; ?>

</body>
</html>
