<?php
// spl_autoload_register(function ($class) {
//     include "../models/" . $class . ".php";
// });

// Initializing Controller
class CommentController
{
    // Function to load Comments by Post Id
    public function loadCommentsbyPostId($postId)
    {
        $c = new Comment();
        $res = $c->loadCommentsbyPostId($postId);
        return $res;
    }

    // Function to Insert new Comments 
    public function newComment($userId, $postId, $description, $mediaUrl)
    {
        $c = new Comment();
        $res = $c->newComment($userId, $postId, $description, $mediaUrl);
        return $res;
    }

    // Function to load Comments by Comment Id
    public function loadCommentsbyCommentId($commentId)
    {
        $c = new Comment();
        $res = $c->loadCommentsbyCommentId($commentId);
        return $res;
    }

    // Function to Edit Comments by Comment Id
    public function editComment($commentId, $description)
    {
        $p = new Comment();
        $res = $p->editComment($commentId, $description);
        return $res;
    }

    // Function to delete Comments by Comment Id
    public function deleteComment($commentId)
    {
        $p = new Comment();
        $res = $p->deleteComment($commentId);
        return $res;
    }
}
