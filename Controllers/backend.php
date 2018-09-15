<?php

 	
use Blog\Model\CommentManager;
use Blog\Model\PostManager;
use Blog\Model\UserManager;

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


function changePost($title = null, $content=null)
{   
    $postManager = new Postmanager();
    if (isset($_POST['title']) && isset($_POST['content']))
    {
        var_dump($title);
        $affectedLines = $postManager->insertPost($title, $content);
        if ($affectedLines === False) {
            throw new Exception('Impossible de modifier l\'episode !');
        }
        deletePost($_GET['id']);
    }
    $post = $postManager-> getPost($_GET['id']);
    require ('Views/changePost.php');
}

function deletePost($id)
{
    $postManager = new Postmanager();
    $deletedpost = $postManager -> deletePost($id);
    if ($deletedpost === False) {
        throw new Exception('Le post n\'a pas été supprimer ! ');
    }
    header('Location: index.php?action=listPosts');
}


function signIn($mail= null, $password= null)
{
    if (isset($_POST['inputEmail']) && isset($_POST['inputPassword']))
    {
        $userManager = new Usermanager();
        $signIn = $userManager -> signIn($mail,$password);
        if($signIn === FALSE){
            throw new Exception ('La connexion a échoué');
        }
        else{echo "Tu es connecté . Bravo";
        die;}
    }
    else{
    require('Views/SignIn.php');
    }
}

function signUp($mail= null, $password= null, $username= null)
{
    
    if (isset($_POST['inputEmail']) && isset($_POST['inputPassword']) && isset($_POST['username']))  {

        $userManager = new Usermanager();
        $affectedLines = $userManager->addUser($mail, $password, $username);
        if ($affectedLines === False) {
            throw new Exception('Impossible de creer le compte !');
        }
            header('Location: index.php?action=listPosts');
    }
    require('Views/SignUp.php');
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


