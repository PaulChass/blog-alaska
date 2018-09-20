<?php 

use Blog\Model\CommentManager;

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

function signalCommment($commentId,$userId)
{
    $commentManager = new Commentmanager();
    $signaledComment = $commentManager -> signalComment($commentId,$userId);
       if ($signaledComment === False) {
        throw new Exception('Impossible de signaler le commentaire !');
    }
    else {
      $postId= $commentManager -> getId($commentId);
      header('Location: index.php?action=post&id='.$postId);
    }	
}

function likeCommment($commentId,$userId)
{
    $commentManager = new Commentmanager();
    $likedComment = $commentManager -> likeComment($commentId,$userId);
       if ($likedComment === False) {
        throw new Exception('Impossible de liker le commentaire !');
    }
    else {
      $postId= $commentManager -> getId($commentId);
      header('Location: index.php?action=post&id='.$postId);
    }	
}

function deleteComment($id)
{
    $commentManager = new Commentmanager();
    $postId= $commentManager -> getId($id);
    $deletedComment = $commentManager -> deleteComment($id);
       if ($deletedComment === False) {
        throw new Exception('Impossible de supprimer le commentaire !');
    }
    else{
    header('Location: index.php?action=post&id='.$postId);
    }
}

