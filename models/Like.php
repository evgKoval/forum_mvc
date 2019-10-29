<?php

class Like
{
    public static function likePost($postId) {
        global $db;

        $userId = $_SESSION['user']['user_id'];

        $sql = 'INSERT INTO likes (is_like, post_id, user_id) ' . 'VALUES (:is_like, :post_id, :user_id)';

        $result = $db->prepare($sql);
        $result->bindParam(':is_like', $isLike = 1, PDO::PARAM_STR);
        $result->bindParam(':post_id', $postId, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);

        $result->execute();
    }

    public static function dislikePost($postId) {
        global $db;

        $userId = $_SESSION['user']['user_id'];

        $sql = 'DELETE FROM likes WHERE post_id = :post_id AND user_id = :user_id';

        $result = $db->prepare($sql);
        $result->bindParam(':post_id', $postId, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);

        $result->execute();
    }

    public static function getLikesByPost($postId) {
        global $db;

        $sql = 'SELECT COUNT(*) FROM likes WHERE post_id = :post_id';

        $result = $db->prepare($sql);
        $result->bindParam(':post_id', $postId, PDO::PARAM_STR);

        $result->execute();

        $likes = $result->fetchColumn();

        return $likes;
    }

    public static function isLiked($postId) {
        global $db;

        $userId = $_SESSION['user']['user_id'];

        $sql = 'SELECT COUNT(*) FROM likes WHERE post_id = :post_id AND user_id = :user_id';

        $result = $db->prepare($sql);
        $result->bindParam(':post_id', $postId, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);

        $result->execute();

        $isLiked = $result->fetchColumn();

        if ($isLiked) {
            return true;
        }
        return false;
    }
}