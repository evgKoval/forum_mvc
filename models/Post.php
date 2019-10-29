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

    public static function getPostById($post_id) 
    {
        global $db;

        $sql = 'SELECT * FROM posts WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $post_id, PDO::PARAM_STR);

        $result->execute();

        $post = $result->fetch();

        return $post;
    }

    public static function createPost($title, $text) 
    {
        global $db;

        $userId = $_SESSION['user']['id'];

        $sql = 'INSERT INTO posts (post_title, post_text, user_id) ' . 'VALUES (:post_title, :post_text, :user_id)';

        $result = $db->prepare($sql);
        $result->bindParam(':post_title', $title, PDO::PARAM_STR);
        $result->bindParam(':post_text', $text, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);

        $result->execute();
    }

    public static function isMyPost($id) {
        if (in_array($id, $_SESSION['user']['posts_id'])) {
            return true;
        }
        return false;
    }
}