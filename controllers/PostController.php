<?php

class PostController 
{
    public function actionShow($id)
    {
        $comment = '';
        
        if (isset($_POST['add_comment'])) {
            $comment = $_POST['comment'];
            
            $errors = false;

            if ($comment === '') {
                $errors[] = 'This field must be filled';
            }
            
            if ($errors == false) {
                $user = Comment::addComment($id, $comment);
            }
        }

        $post = [];
        $post = Post::getPostById($id);

        $comments = [];
        $comments = Comment::getCommentsByPost($id);

        require_once(ROOT . '/views/post/show.php');
        
        return true;
    }

    public function actionCreate() 
    {
        $categories = Category::getSubCategories();

        if (isset($_POST['post_create'])) {
            $title = $_POST['post_title'];
            $text = $_POST['post_text'];
            $category = $_POST['post_category'];

            $errors = false;

            if ((!isset($title) || empty($title)) && (!isset($text) || empty($text))) {
                $errors[] = 'The fields must be filled';
            }

            if ($errors == false) {
                Post::createPost($title, $text, $category);

                header("Location: /");
            }
        }

        require_once(ROOT . '/views/post/create.php');
        
        return true;
    }

    public function actionEdit($id)
    {
        $post = Post::getPostById($id);

        if (!Post::isMyPost($id)) {
            header("Location: /");
        } else {
            $title = $post['post_title'];
            $text = $post['post_text'];

            if (isset($_POST['post_edit'])) {
                $title = $_POST['post_title'];
                $text = $_POST['post_text'];
                
                $errors = false;
                
                if ($title == '' || $text == '') {
                    $errors[] = 'The fields must be filled';
                }
                
                if ($errors == false) {
                    Post::editPost($id, $title, $text);
                }
            }

            require_once(ROOT . '/views/post/edit.php');

            return true;
        }
    }

    public function actionDelete($id)
    {
        if (!Post::isMyPost($id)) {
            header("Location: /");
        } else {
            Post::deletePost($id);

            header("Location: /");

            return true;
        }
    }

    public function actionGetComments($id) 
    {
        $comments = Comment::getCommentsByPost($id); 

        echo json_encode($comments);

        return true;
    }

    public function actionLikePost($id) 
    {
        Like::likePost($id);

        header('Location: ' . $_SERVER['HTTP_REFERER']);

        return true;
    }

    public function actionDislikePost($id) 
    {
        Like::dislikePost($id);

        header('Location: ' . $_SERVER['HTTP_REFERER']);

        return true;
    }
}