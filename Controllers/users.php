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
            throw new Exception ('Utilisateur ou mot de passe incorrect');
        }
        else{
            $postManager = new Postmanager();
            $commentManager = new Commentmanager();
            $user = $userManager -> getUser($mail);
            $countPosts = $postManager -> countPosts();
            $countComments = $commentManager -> countComments();
            $countLikedComments = $commentManager -> countLikedComments();
            $countSignaledComments = $commentManager -> countSignaledComments();
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
                $_SESSION['mail'] = $mail;
                $_SESSION['userType'] = $user['userType'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['userId'] =$user['id'];
                if ($user['userType']=="admin") {
                    require('Views/Dashboard.php');}
                else{ 
                    header('Location: index.php?action=listPosts');
                }
                //FINIR: commencer par faire getUser(mail) si type=admin dashboard sinon index ... sur index remplacer 
                
            die;}
        }
    }
    else{
    require('Views/SignIn.php');
    }
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
        $affectedLines = $userManager->addUser($mail, $password, $username);
        if ($affectedLines === False) {
            throw new Exception('Impossible de creer le compte !');
        }
            header('Location: index.php?action=listPosts');
    }
    require('Views/SignUp.php');
}





