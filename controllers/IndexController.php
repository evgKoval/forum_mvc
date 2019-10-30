<?php

class IndexController 
{
	public function actionIndex() 
	{
		$posts = [];
		$posts = Post::getPosts();

		require_once(ROOT . '/views/site/index.php');

		return true;
	}

    public function actionPreferences() {
        $categories = [];
        $categories = Category::getCategories();

        $subCategories = [];
        $subCategories = Category::getSubCategories();

        if(isset($_POST['preferences'])) {
            $errors = false;
            var_dump($_POST);

            if (!$_POST['category'] && !$_POST['subcategory']) {
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
}