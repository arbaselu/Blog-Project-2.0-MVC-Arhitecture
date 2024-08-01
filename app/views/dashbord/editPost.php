?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit post</title>
    <link rel="stylesheet" href="/public/assets/css/dashbord.css">
</head>
<script defer src="/public/assets/js/functions.js"></script>
<body>
    
<div class="page-content">
<h2>Edit article:</h2>
<div class="main-content"></div>
  <form action ="/EditPost/edit"  method="POST">
  <input type="hidden" name="slug" value="<?php if(isset($data['posts']['slug']) && !empty($data['posts']['slug'])) echo $data['posts']['slug'] ;?>">
    <input type="text" name="new_title" placeholder="Titlul articolului" value ="<?php if(isset($data['posts']['post_title']) && !empty($data['posts']['post_title'])) echo $data['posts']['post_title'];?>"><?php if (isset($_SESSION['titleError'])) echo $_SESSION['titleError'];?><br>
    <label>Public:</label>
    <select name = "new_public">
        <option value="0" <?php if($data['posts']['public'] == 0) echo "selected";?>>No</option>
        <option value="1" <?php if($data['posts']['public'] == 1) echo "selected";?>>Yes</option>
    </select><br>
    <textarea name="new_content" cols="80" rows="20" ><?php if(isset($data['posts']['post_content']) && !empty($data['posts']['post_content'])) echo $data['posts']['post_content'];?></textarea><?php if (isset($_SESSION['contentError'])) echo  $_SESSION['contentError']; ?><br>
    <input class="button" type ="submit" value="Edit Post"><br>
  </form>

</div>
</div>

</body>
</html>