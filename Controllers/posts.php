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
    $post = $postManager->getPost($id);
    $comments = $commentManager -> getComments($id);
    $posts = $postManager->getPosts();
    $postsNumber = $postManager->countPosts();
    require('Views/postView.php');
}

function listPosts()
{
    $postManager = new PostManager();
    $postManager2 = new Postmanager();
    $lposts = $postManager->getPosts();
    $posts = $postManager->getPosts();
    $postsNumber = $postManager->countPosts();
    require('Views/indexView.php');
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
    require('Views/newPost.php');
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
    $commentManager = new Commentmanager();
    $deletedComments = $commentManager -> deletePostComments($id);
    $deletedpost = $postManager -> deletePost($id);
    if ($deletedpost === False) {
        throw new Exception('Le post n\'a pas été supprimer ! ');
    }
    header('Location: index.php?action=listPosts');
}


