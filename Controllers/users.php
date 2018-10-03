<?php

use Blog\Model\UserManager;
use Blog\Model\PostManager;
use Blog\Model\CommentManager;

function signIn($mail= null, $password= null)
{
    if (isset($_POST['inputEmail']) && isset($_POST['inputPassword']))
    {
        $userManager = new Usermanager();
        $signIn = $userManager -> signIn($mail,$password);
        if($signIn === FALSE){
            $e ='Utilisateur ou mot de passe incorrect';
            require('Views/SignIn.php');
            die;
        }
        else{
            $postManager = new Postmanager();
            $commentManager = new Commentmanager();
            $user = $userManager -> getUser($mail);
            $countPosts = $postManager -> countPosts();
            $countComments = $commentManager -> countComments();
            $countLikedComments = $commentManager -> countLikedComments();
            $countSignaledComments = $commentManager -> countSignaledComments();
            $posts = $postManager->getPosts();
            if($countComments === FALSE )
            {
                throw new Exception ("Le nombre de commentaire n/'as pas été récupéré");
            }
            else if ($countLikedComments === FALSE)
            {
                throw new Exception ("Le nombre de commentaire liké n/'as pas été récupéré");
            }
            else if ($countSignaledComments === FALSE)
            {
                throw new Exception ("Le nombre de commentaire n/'as pas été récupéré");
            }
            else if ($countPosts === FALSE){
                throw new Exception ("Le nombre de post n'as pas été récupéré");
            }


            else {
                $e ="Authentification réussie!"; 
                $_SESSION['mail'] = $mail;
                $_SESSION['userType'] = $user['userType'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['userId'] =$user['id'];
                if ($user['userType']=="admin") {
                $action='dashboard';}
                else{ 
                    $action='listPosts';
                }  
            showError($e,$action);      
            die;}
        }
    }
    else{
    require('Views/SignIn.php');
    die;
    }
    die;
}
function dashboard(){
    $postManager = new Postmanager();
    $commentManager = new Commentmanager();
    $countPosts = $postManager -> countPosts();
    $countComments = $commentManager -> countComments();
    $countLikedComments = $commentManager -> countLikedComments();
    $countSignaledComments = $commentManager -> countSignaledComments();
    $posts = $postManager->getPosts();
    if($countComments === FALSE )
    {
        throw new Exception ("Le nombre de commentaire n/'as pas été récupéré");
    }
    else if ($countLikedComments === FALSE)
    {
        throw new Exception ("Le nombre de commentaire liké n/'as pas été récupéré");
    }
    else if ($countSignaledComments === FALSE)
    {
        throw new Exception ("Le nombre de commentaire n/'as pas été récupéré");
    }
    else if ($countPosts === FALSE){
        throw new Exception ("Le nombre de post n'as pas été récupéré");
    }
    else {
            require('Views/Dashboard.php');}
    }

function signOut()
{
    session_start();
    session_destroy();
    header('Location: index.php?action=listPosts');
}



function signUp($mail= null, $password= null, $username= null)
{
    
    if (isset($_POST['inputEmail']) && isset($_POST['inputPassword']) && isset($_POST['username']))  {
        $userManager = new Usermanager();
        
        $checkEmail = $userManager->checkEmail($mail);
        if($checkEmail ===  FALSE){
            $e='Addresse email déja utilisé!';
            require('Views/SignUp.php');
            die;
        }
        else {
            $affectedLines = $userManager->addUser($mail, $password, $username);
            if($affectedLines === FALSE){
            $e='Les mots de passe ne correspondent pas. Veuillez réessayer';
            require('Views/SignUp.php');
            die;
            }
        } 
        $e="Vous inscription a bien été enregistrer !";
        showError($e);
        die;
        
    }
    require('Views/SignUp.php');
    die;
}




