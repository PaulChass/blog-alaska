<?php

require('Models/PostManager.php');
require('Models/CommentManager.php');
use Blog\Model\PostManager;
use Blog\Model\CommentManager;
function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    require('Views/indexView.php');
}

function post($id)
{
    $postManager = new Postmanager();
    $commentManager = new CommentManager();
    $post = $postManager->getPost($id);
    $comments = $commentManager -> getComments($id);
    require('Views/postView.php');
}



function addComment($postId, $userId, $comment)
{
    $commentManager = new Commentmanager();
    $affectedLines = $commentManager->insertComment($postId, $userId, $comment);
    if ($affectedLines === False) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        echo "Commentaire ajouté";
        header('Location: index.php?action=post&id=' . $postId);
    }
}




