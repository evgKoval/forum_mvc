<?php

class Category
{
    public static function getCategories()
    {
        global $db;

        $sql = 'SELECT * FROM categories';

        $result = $db->prepare($sql);

        $result->execute();

        $categories = $result->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }

    public static function getSubCategories()
    {
        global $db;

        $sql = 'SELECT * FROM sub_categories';

        $result = $db->prepare($sql);

        $result->execute();

        $subCategories = $result->fetchAll(PDO::FETCH_ASSOC);

        return $subCategories;
    }

    public static function getSubCategoriesByCategoryId($categoryId)
    {
        global $db;

        $sql = 'SELECT s.id, s.name FROM categories c LEFT JOIN sub_categories s ON c.id = s.parent WHERE c.id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $categoryId, PDO::PARAM_STR);

        $result->execute();

        $subCategories = $result->fetchAll(PDO::FETCH_ASSOC);

        return $subCategories;
    }

    public static function addUserPreferences($category, $subCategory) {
        global $db;

        $userId = $_SESSION['user']['user_id'];

        $sql = 'INSERT INTO user_preferences (user_id, category, sub_category) ' . 'VALUES (:user_id, :category, :sub_category)';

        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $result->bindParam(':category', $category, PDO::PARAM_STR);
        $result->bindParam(':sub_category', $subCategory, PDO::PARAM_STR);

        $result->execute();
    }
}