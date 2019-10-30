<?php

class Comment
{
	public static function getCommentsByPost($post_id) 
	{
		global $db;

		$sql = 'SELECT c.comment, c.created_at, u.first_name FROM comments c LEFT JOIN users u ON c.user_id = u.id WHERE post_id = :post_id ORDER BY created_at ASC';

		$result = $db->prepare($sql);
		$result->bindParam(':post_id', $post_id, PDO::PARAM_STR);

		$result->execute();

		$comments = $result->fetchAll(PDO::FETCH_ASSOC);

		return $comments;
	}

	public static function addComment($postId, $comment) 
    {
		global $db;

		$userId = $_SESSION['user']['user_id'];

		$sql = 'INSERT INTO comments (post_id, user_id, comment) ' . 'VALUES (:post_id, :user_id, :comment)';

		$result = $db->prepare($sql);
		$result->bindParam(':post_id', $postId, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $result->bindParam(':comment', $comment, PDO::PARAM_STR);

		$result->execute();

        $authorEmail = Post::getEmailByPostId($postId);

        if ($authorEmail) {
            Mailer::sendNotificate($authorEmail, $postId);
        }
	}
}