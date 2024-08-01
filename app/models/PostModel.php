<?php

require_once 'app/core/Model.php';
require_once 'logs/logError.php';

class PostModel extends Model
{
        public function getPostsHome()
        {
    
          // SQL query to retrieve posts with author information
                $sql = "SELECT posts.id,
                    posts.post_title,
                     posts.slug,
                    posts.post_content,
                    posts.public,
                    posts.created_at,
                    users.full_name,
                    (SELECT youtube_link FROM assets_website ) AS link
                            FROM posts 
                            LEFT JOIN users ON posts.author_id = users.id
                             WHERE posts.public = 1 
                            ORDER BY posts.id LIMIT 3";
    if ($stmt = $this->connect->prepare($sql)) {
        // Execute the query
        if ($stmt->execute()) {
            // Fetch all posts
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } else {
            logError("Failed to execute query.", __FILE__, __LINE__);
            header("Location: error.php");
            exit();
        }
    } else {
        logError("Failed to prepare query.", __FILE__, __LINE__);
        header("Location: error.php");
                exit();
            }
        }
    public function getPostsBlog()
    {

    // SQL query to retrieve posts with author information
    $sql = "SELECT posts.id,
               posts.post_title,
               posts.slug,
               posts.post_content,
               posts.public,
               posts.created_at,
               users.full_name
                    FROM posts 
                    LEFT JOIN users ON posts.author_id = users.id 
                    WHERE posts.public = 1
                    ORDER BY posts.id DESC";

        if ($stmt = $this->connect->prepare($sql)) {
            // Execute the query
            if ($stmt->execute()) {
                // Fetch all posts
             return $stmt->fetchAll(PDO::FETCH_ASSOC);
             
           
            } else {
                logError("Failed to execute query.", __FILE__, __LINE__);
                header("Location: error.php");
                exit();
            }
        } else {
            logError("Failed to prepare query.", __FILE__, __LINE__);
            header("Location: error.php");
            exit();
        }
    }

   
        public function getPost($slug) {
            $sql = "SELECT posts.id,
                           posts.post_title,
                           posts.slug,
                           posts.post_content,
                           posts.public,
                           posts.created_at,
                           users.full_name
                    FROM posts 
                    LEFT JOIN users ON posts.author_id = users.id
                    WHERE posts.slug = :slug";
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(':slug', $slug);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

function createSlugTitle($title) {
    $slug = strtolower($title);
    $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}


    }



