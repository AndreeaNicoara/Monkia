<?php

class CommentController
{
    public function loadCommentsbyPostId($postId)
    {
        $c = new Comment();
        $res = $c->loadCommentsbyPostId($postId);
        return $res;
    }

    public function newComment($userId, $postId, $description, $mediaUrl)
    {
        $c = new Comment();
        $res = $c->newComment($userId, $postId, $description, $mediaUrl);
        return $res;
    }

    public function loadCommentsbyCommentId($commentId)
    {
        $c = new Comment();
        $res = $c->loadCommentsbyCommentId($commentId);
        return $res;
    }

    public function editComment($commentId, $description)
    {
        $p = new Comment();
        $res = $p->editComment($commentId, $description);
        return $res;
    }

    public function deleteComment($commentId)
    {
        $p = new Comment();
        $res = $p->deleteComment($commentId);
        return $res;
    }
}
