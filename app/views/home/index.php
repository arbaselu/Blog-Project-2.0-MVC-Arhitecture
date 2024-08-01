

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mario's Blog</title>
    <link rel="stylesheet" href="Style/indexStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Proxima+Nova:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/assets/css/navbar.css">
    <link rel="stylesheet" href="/public/assets/css/home.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
    
</head>
<script defer src="/public/assets/js/functions.js"></script>
<body>

<header>
    <?php require_once 'app/views/navbar/index.php'; ?>
</header>

<main>
        <div class="main">
            <div class="newsletter">
                <h1>ACCELEREAZĂ-ȚI CARIERA
                LA URMĂTORUL NIVEL!</h1>
                <div class="text-newsletter">
                    <p><img src ="/public/assets/Icons/arrow.svg" alt="arrow">Inveți cum funcționează lucrurile, nu doar cum se fac</p>
                    <p><img src ="/public/assets/Icons/arrow.svg" alt="arrow">Strategii de carieră și conversie profesională</p>
                    <p><img src ="/public/assets/Icons/arrow.svg" alt="arrow">Explorezi piața de dezvoltare software și cele mai noi tehnologii</p>
                </div>
                
                    <form class="form-newsletter" action="/home/newsletter" method="POST"> 
                        <input type="email" name="email_newsletter" placeholder="Email" required>
                        <button type="submit" class="submit_button">MA INSCRIU LA NEWSLETTER</button>
                    </form>  
            </div>

            <div class="blog-articles">
                <div class="title"><h1>Cele mai recente articole</h1></div>
                    <div class="new-article">
                        <?php
                            foreach($data['posts'] as $post) {
                                echo '<div class="article">
                                    <a href="blog/'.$post['slug'].'"><h2>'.$post['post_title'].'</h2></a><br>  
                                    <p>'.mb_strimwidth($post['post_content'], 0, 200, "...").'</p>
                                    </div>';
                            }
                        ?>
                    </div>                    
            </div>
                   

            <div class="youtube">
                <h3>RECENT PE YOUTUBE</h3>
                    <?php
                        if (filter_var($post['link'], FILTER_VALIDATE_URL)) {
                            echo '<iframe class="video" src="'.$post['link'].'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
                        } 
                            else {
                                    echo '<p>No recent video</p>';
                                }
                        ?>
            </div>
        </div>

</main>

<footer>
    <?php require_once 'app/views/footer/index.php'; ?>
</footer>

</body>
</html>
