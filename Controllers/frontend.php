<?php

require('Models/PostManager.php');
use Blog\Model\PostManager;
function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    require('Views/index.php');
}

function post()
{
    $post = getPost($_GET['id']);
    $comments = getComments($_GET['id']);

    require('View/postView.php');
}
function addComment($postId, $author, $comment)
{
    $affectedLines = postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

/*
function signalCommment($postId)
{
	A FAIRE
}
*/ 

