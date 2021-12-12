<?php

// Initialize Class
class CategoryController
{
    // Categories
    // Function to load All Categories
    public function loadCategories()
    {
        // Calling Class Category
        $c = new Category();
        $res = $c->loadCategories();
        return $res;
    }

    // Function to load All Categories by user Id
    public function getUserCategories()
    {
        $c = new User($_SESSION['userId']);
        $res = $c->getUserCategories();
        return $res;
    }

    // Function to load All Categories by ID
    public function loadCategoryById($categoryName)
    {
        $c = new Category();
        $res = $c->loadCategoryById($categoryName);
        return $res;
    }

    // Function to load Category Followers
    public function getCategoryFollowers($categoryName)
    {
        $c = new Category();
        $res = $c->getCategoryFollowers($categoryName);
        return $res;
    }

    // Function to check if user is follower
    public function isUserFollower($categoryName, $userId)
    {
        $c = new Category();
        $res = $c->isUserFollower($categoryName, $userId);
        return $res;
    }

    // Function to register Cateogry 
    public function registerUserCategories($userId, $categories)
    {
        $c = new Category();
        $res = $c->registerUserCategories($userId, $categories);
        return $res;
    }
}
