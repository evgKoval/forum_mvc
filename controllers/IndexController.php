<?php

class IndexController 
{
	public function actionIndex() 
	{
        $preferences = [];
        $posts = [];

        if (!User::isGuest()) {
            $preferences = User::getUserPreferences();

            $posts = Post::getPosts($preferences);
        } else {
            $posts = Post::getPosts();
        }

		require_once(ROOT . '/views/site/index.php');

		return true;
	}

    public function actionPreferences() {
        $categories = [];
        $categories = Category::getCategories();

        $subCategories = [];
        $subCategories = Category::getSubCategories();

        $category = '';
        $subCategories = [];

        if (isset($_POST['preferences'])) {
            $category = $_POST['category'];

            $errors = false;
            
            if (isset($_POST['subcategory'])) {
                $subCategories = $_POST['subcategory'];

                foreach ($subCategories as $subCategory) {
                    Category::addUserPreferences($category, $subCategory);
                }

                header("Location: /");
            } else {
                $errors[] = 'Please choose at least one';
            }
        }

        require_once(ROOT . '/views/site/preferences.php');
        
        return true;
    }

    public function actionGetPreferences($categoryId)
    {
        $subCategories = Category::getSubCategoriesByCategoryId($categoryId); 

        echo json_encode($subCategories);

        return true;
    }

    public function actionSearch() {
        $query = $_GET['query'];

        $posts = [];
        $preferences = [];

        if (!User::isGuest()) {
            $preferences = User::getUserPreferences();

            $posts = Post::getPostsBySearch($query, $preferences);
        } else {
            $posts = Post::getPostsBySearch($query);
        }

        require_once(ROOT . '/views/site/search.php');

        return true;   
    }
}