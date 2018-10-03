<?php

require('Models/PostManager.php');
require('Models/CommentManager.php');
require('Models/UserManager.php');

use Blog\Model\PostManager;
use Blog\Model\CommentManager;
use Blog\Model\UserManager;

function post($id)
{
    $postManager = new Postmanager();
    $commentManager = new CommentManager();
    $userManager = new UserManager();
    $post = $postManager -> getPost($id);
    $comments = $commentManager -> getComments($id);
    $posts = $postManager -> getPosts();
    $postsNumber = $postManager -> countPosts();
    require('Views/postView.php');
}

function listPosts()
{
    $postManager = new PostManager();
    $postManager2 = new Postmanager();
    $lposts = $postManager -> getPosts();
    $posts = $postManager -> getPosts();
    $postsNumber = $postManager -> countPosts();
    require('Views/indexView.php');
}


function addPost($title = null, $content = null)
{
    if(isAdmin()==TRUE) {
    if (isset($_POST['title']) && isset($_POST['content'])) {

        $postManager = new Postmanager();
        $affectedLines = $postManager->insertPost($title, $content);
        if ($affectedLines === False) {
            throw new Exception('Impossible d\'ajouter l\'episode !');
        }
        $e='L\'episode à bien été posté !';
        showError($e);
        die;
    }
    require('Views/newPost.php');
    } else showError($e="L'accès de cette page est réservé à l'administrateur....     Veuillez vous connecter. ",$action="signIn");
    die;
}


function changePost($postId,$title = null, $content=null )
{   
    if(isAdmin()==TRUE) {
        $postManager = new Postmanager();
        if (isset($_POST['title']) && isset($_POST['content'])) {
            $date = $postManager->getCreateDate($postId);
            $affectedLines = $postManager->updatePost($title, $content,$date);
            $id= $postManager -> getPostId($date);
            $commentManager = new CommentManager();
            $affectedcomments = $commentManager -> changePostId($postId,$id);
            if ($affectedcomments === False) {
                $e ='Erreur lors de la modification du post';
            }    else    {
            $e = "L'épisode a bien été modifier";
            }
            deletePost($_GET['id'],$e);
        }
        $post = $postManager-> getPost($_GET['id']);
        require('Views/changePost.php');
    } else showError($e="L'accès de cette page est réservé à l'administrateur....     Veuillez vous connecter. ",$action="signIn");
}


function deletePost($id,$e=null)
{
    if(isAdmin()==TRUE) {
    $postManager = new Postmanager();
    $commentManager = new Commentmanager();
    $deletedComments = $commentManager -> deletePostComments($id);
    $deletedpost = $postManager -> deletePost($id);
    if ($deletedpost === False) {
        $e='Le post n\'a pas été supprimer ! ';
        $action ='post&id='.$id;
        showError($e,$action);
    }    else    {
    if(!isset($e)) {
        $e = "Le post a bien été supprimé";
    }
    showError($e);    }
    die;
    } else showError($e="L'accès de cette page est réservé à l'administrateur....     Veuillez vous connecter. ",$action="signIn");
}


