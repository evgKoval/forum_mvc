<?php

class Post 
{
    public static function getPosts() 
    {
        global $db;

        $sql = 'SELECT * FROM posts';

        $result = $db->prepare($sql);

        $result->execute();

        $posts = $result->fetchAll(PDO::FETCH_ASSOC);

        return $posts;
    }

    public static function getPostById($postId) 
    {
        global $db;

        $sql = 'SELECT * FROM posts WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $postId, PDO::PARAM_STR);

        $result->execute();

        $post = $result->fetch();

        return $post;
    }

    public static function createPost($title, $text, $category) 
    {
        global $db;

        $userId = $_SESSION['user']['id'];

        $sql = 'INSERT INTO posts (post_title, post_text, post_category, user_id) ' . 'VALUES (:post_title, :post_text, :post_category, :user_id)';

        $result = $db->prepare($sql);
        $result->bindParam(':post_title', $title, PDO::PARAM_STR);
        $result->bindParam(':post_text', $text, PDO::PARAM_STR);
        $result->bindParam(':post_category', $category, PDO::PARAM_INT);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);

        $result->execute();
    }

    public static function editPost($postId, $title, $text) {
        global $db;

        $sql = 'UPDATE posts SET post_title = :post_title, post_text = :post_text WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':post_title', $title, PDO::PARAM_STR);
        $result->bindParam(':post_text', $text, PDO::PARAM_STR);
        $result->bindParam(':id', $postId, PDO::PARAM_STR);

        $result->execute();
    }

    public static function deletePost($postId)
    {
        global $db;

        $sql = 'DELETE FROM posts WHERE id = :post_id';

        $result = $db->prepare($sql);
        $result->bindParam(':post_id', $postId, PDO::PARAM_STR);

        $result->execute();
    }

    public static function isMyPost($id) {
        if (in_array($id, $_SESSION['user']['posts_id'])) {
            return true;
        }
        return false;
    }

    public static function getEmailByPostId($id) {
        global $db;

        $sql = 'SELECT u.email FROM posts p INNER JOIN users u ON p.user_id = u.id WHERE p.id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);

        $result->execute();

        $email = $result->fetch();

        return $email['email'];
    }
}