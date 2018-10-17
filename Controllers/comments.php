<?php 



use Blog\Model\CommentManager;


function addComment($postId, $comment)
{
    
    $commentManager = new Commentmanager();

    if (!empty($_POST['comment'])){ 
        if( isset($_SESSION['userId']))
        {
            $affectedLines = $commentManager->insertComment($postId,$_SESSION['userId'], $comment);  
        }
        else{
        $affectedLines = $commentManager->insertComment($postId,20, $comment);}
        if ($affectedLines === False) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
      header('Location: index.php?action=post&id='.$postId);
        }

}

function signalCommment($commentId,$userId)
{
    $commentManager = new Commentmanager();
    $signaledComment = $commentManager -> signalComment($commentId,$userId);
       if ($signaledComment === False) {
       $e='Impossible de signaler le commentaire !';
    } else {
      $postId= $commentManager -> getId($commentId);
      $e='Le commentaire à été signalé et est en attente de modération.';
            $action='post&id='.$postId;
            showError($e,$action);
    }	
}

function likeCommment($commentId,$userId)
{
    $commentManager = new Commentmanager();
    $likedComment = $commentManager -> likeComment($commentId,$userId);
       if ($likedComment === False) {
        throw new Exception('Impossible de liker le commentaire !');
    } else {
      $postId= $commentManager -> getId($commentId);
      header('Location: index.php?action=post&id='.$postId);
    }	
}

function listSignaledComments()
{
    $commentManager = new Commentmanager();
    $signaledComments = $commentManager -> listSignaledComments();
    require('Views/signaledComments.php');
}

function listlikedComments()
{
    $commentManager = new Commentmanager();
    $likedComments = $commentManager -> listlikedComments();
    require('Views/likedComments.php');
}
function deleteComment($id)
{
    $commentManager = new Commentmanager();
    $postId= $commentManager -> getId($id);
    $deletedComment = $commentManager -> deleteComment($id);
       if ($deletedComment === False) {
        throw new Exception('Impossible de supprimer le commentaire !');
    } else {
    header('Location: index.php?action=post&id='.$postId);
    }
}


