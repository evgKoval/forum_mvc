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
}