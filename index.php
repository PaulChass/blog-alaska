<?php
session_start();

require('Controllers/comments.php');
require('Controllers/posts.php');
require('Controllers/users.php');
require('Services/services.php');
try {  
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();    
        }   elseif ($_GET['action'] == 'post') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    post($_GET['id']);
                } else {
                    $e='Aucun identifiant de billet envoyé';
                    $action='listPosts';
                }
        }   elseif ($_GET['action']=='listSignaledComments') {
            listSignaledComments();
        }   elseif ($_GET['action']=='listlikedComments')   {
            listlikedComments();
        }   elseif ($_GET['action'] == 'addComment') {    
                if (isset($_POST['comment']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'],$_POST['comment']);
                }   else    {
                    post($_GET['id']);
                } 
        }   else if($_GET['action']=='signalComment' )  {
                if (isset($_GET['id'])) {
                    signalCommment($_GET['id'],$_SESSION['userId']);
                }   else    { 
                $e='Aucun identifiant de commentaire selectionné' ;
            }
        } else if($_GET['action']=='likeComment' ){
            if (isset($_GET['id']))
            {
                likeCommment($_GET['id'],$_SESSION['userId']);
            }
            else { 
            
                $e='Aucun identifiant de commentaire selectionné';
            }
        } else if($_GET['action']==  'signIn'){
            if (!empty($_POST['inputEmail']) && !empty($_POST['inputPassword'])){    
                signIn($_POST['inputEmail'] , $_POST['inputPassword']);
            }
            signIn();
            die;
        } else if($_GET['action']==  'signUp'){
            
            if (!empty($_POST['inputEmail']) && !empty($_POST['inputPassword']) && $_POST['inputPassword'] == $_POST['confirmPassword'] && !empty($_POST['username'] ) ) {    
                signUp($_POST['inputEmail'] , $_POST['inputPassword'], $_POST['username']);
            }
            signUp();
        } else if($_GET['action']=='signOut' ) {
            signOut();
        } else if($_GET['action']=='addPost' ) {
            if (!empty($_POST['title']) && !empty($_POST['content']) ) {
                    addPost($_POST['title'] , $_POST['content']);
                }
            else
            {
                addPost();
            }
        } else if($_GET['action']== 'deleteComment'){
            if (isset($_GET['id']) && $_GET['id'] > 0) { 
                deleteComment($_GET['id']);
            }
            else {
                $e ='Aucun identifiant de commentaire envoyé' ;
            }
        } else if($_GET['action']=='changePost') { 
            if (!empty($_POST['title']) && !empty($_POST['content']) ) {
                changePost($_GET['id'] , $_POST['title'] ,  $_POST['content']);
            } else if (isset($_GET['id']) && $_GET['id'] > 0)  {  
                changePost($_GET['id']);
            } else $e='Aucun identifiant de billet envoyé';
        } else if($_GET['action']=='deletePost' ) {
            if (isset($_GET['id']) && $_GET['id'] > 0) { 
                deletePost($_GET['id']);
            } else {
                $e = 'Aucun identifiant de billet envoyé' ;
            }
        } else if($_GET['action']=='dashboard') {
            if(isAdmin()==TRUE){
                dashboard();
            } else {
            showError($e="L'accès de cette page est réservé à l'administrateur....     Veuillez vous connecter. ",$action="signIn");
            die;
        }
        } else{
            $e ='Aucune action choisi';
        }
    } else {        
    listPosts();
    }
}

finally {
    if (isset($e)) {
    showError($e); 
} else die; 
}
       



            
                     
