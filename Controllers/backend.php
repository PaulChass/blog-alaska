<?php

 	
use Blog\Model\CommentManager;
use Blog\Model\PostManager;

function signalCommment($commentId,$userId)
{
    $commentManager = new Commentmanager();
    $signaledComment = $commentManager->signalComment($commentId,$userId);
       if ($signaledComment === False) {
        throw new Exception('Impossible de signaler le commentaire !');
    }
    else {
        echo "Commentaire signalé";
      header('Location: index.php?ection=post&id='.$signalcomment($postId));
    }	
}


function addPost($title = null, $content = null)
{
    if (isset($_POST['title']) && isset($_POST['content']))
    {

        $postManager = new Postmanager();
        $affectedLines = $postManager->insertPost($title, $content);
        if ($affectedLines === False) {
            throw new Exception('Impossible d\'ajouter l\'episode !');
        }
            header('Location: index.php?action=listPosts');
    }
    require('Views/NewPost.php');
}


function newPost()
{

}


function signIn()
{
    require('Views/SignIn.php');
}