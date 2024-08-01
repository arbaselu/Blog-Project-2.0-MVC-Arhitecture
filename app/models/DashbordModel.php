<?php

require_once 'app/core/Model.php';
require_once 'logs/logError.php';

class DashbordModel extends Model
{

public function createPost($slug,$title,$content,$public){

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    clearSessionErrors();
    $title = sanitize($_POST['title']);
    $public = sanitize($_POST['public']);
    $content = $_POST['content']; 

    if (empty($title) || empty($content) ) {
        $_SESSION['contentError'] = "Title or content is required!";
    } else if (strlen($title) > 255) {
        $_SESSION['contentError'] = "Title is too long!";
    }

    if (empty($_SESSION['titleError']) && empty($_SESSION['contentError'])) {
        $sql = "INSERT INTO posts (post_title,slug,public, post_content, author_id) VALUES (:title, :slug,:public, :content, :author_id)";
        
        try {
            if ($stmt = $this->connect->prepare($sql)) {
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':slug', $slug);
                $stmt->bindParam(':public', $public);
                $stmt->bindParam(':content', $content);
                $author_id = $_SESSION['id'];
                $stmt->bindParam(':author_id', $author_id);
                logError("Failed to prepare statement", __FILE__, __LINE__);
                return $stmt->execute();
                //echo "Post uploaded successfully!";
                    } else {
                        header("Location: /error");
                        exit();
            }
        } catch (Exception $e) {
            logError("Exception: " . $e->getMessage(), __FILE__, __LINE__);
            header("Location: /error");
            exit();
        }
    }
}
}


public function editPost($slug,$title,$content,$public){
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    clearSessionErrors();

    if (empty($title)) {
        $_SESSION['titleError'] = "Title is required!";
    } elseif (strlen($title) > 255) {
        $_SESSION['titleError'] = "Title is too long!";
    }

    if (empty($content)) {
        $_SESSION['contentError'] = "Content is required!";
    }

    if (empty($_SESSION['titleError']) && empty($_SESSION['contentError']) && !empty($slug)) {
        // Update post
        $sql = "UPDATE posts SET post_title = :post_title_update, post_content = :post_content_update, public = :public_update WHERE slug = :slug";
        try {
            if ($stmt = $this->connect->prepare($sql)) {
                $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
                $stmt->bindParam(':post_title_update', $title, PDO::PARAM_STR);
                $stmt->bindParam(':post_content_update', $content, PDO::PARAM_STR);
                $stmt->bindParam(':public_update', $public, PDO::PARAM_INT);

                if ($stmt->execute()) {
                   return true;    
                } else {
                    logError("Failed to execute update query", __FILE__, __LINE__);
                    $_SESSION['titleError'] = "Error executing update query.";
                    return false;
                }
            } else {
                logError("Failed to prepare update statement", __FILE__, __LINE__);
                $_SESSION['titleError'] = "Error preparing update statement.";
            }
        } catch (Exception $e) {
            logError("Exception: " . $e->getMessage(), __FILE__, __LINE__);
            $_SESSION['titleError'] = "An unexpected error occurred.";
        }
    }
}

}

public function deletePost($slug){
    $sql = "DELETE FROM posts WHERE slug = :slug";
    try {
        if ($stmt = $this->connect->prepare($sql)) {
            $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
            if ($stmt->execute()) {
                return true;
            } else {
                logError("Failed to execute delete statement", __FILE__, __LINE__);
                return false;
            }
        } else {
            logError("Failed to prepare delete statement", __FILE__, __LINE__);
            return false;
        }
    } catch (Exception $e) {
        logError("Exception: " . $e->getMessage(), __FILE__, __LINE__);
        return false;
    }
}
 
}





