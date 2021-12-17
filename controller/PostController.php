<?php
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../models/' . $class . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Initializing Controller
class PostController
{
    // Defining functions for Posts
    public function loadUserFeedPostsFiltered($userId, $filter)
    {
        $p = new Post();
        $res = $p->loadUserFeedPostsFiltered($userId, $filter);
        return $res;
    }
    public function loadPostById($postId)
    {
        $p = new Post();
        $res = $p->loadPostById($postId);
        return $res;
    }

    public function loadCategoryPosts($categoryName)
    {
        $p = new Post();
        $res = $p->loadCategoryPosts($categoryName);
        return $res;
    }

    public function newPost($userId, $title, $categoryName, $mediaUrl, $description)
    {
        $p = new Post();
        $res = $p->newPost($userId, $title, $categoryName, $mediaUrl, $description);
        return $res;
    }

    public function editPost($userId, $title, $description)
    {
        $p = new Post();
        $res = $p->editPost($userId, $title, $description);
        return $res;
    }
    public function deletePost($postId)
    {
        $p = new Post();
        $res = $p->deletePost($postId);
        return $res;
    }
}
