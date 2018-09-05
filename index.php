<?php

require('Controllers/frontend.php');
require('Controllers/backend.php');

try { 
// Listposts   
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'listPosts') {
        listPosts();    
    }
// Get Post&coments   
    elseif ($_GET['action'] == 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            post($_GET['id']);
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }
// AddComment 
      elseif ($_GET['action'] == 'addComment') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['comment'])) {
                addComment($_GET['id'],1, $_POST['comment']);
            }
            else {
                echo 'Erreur : tous les champs ne sont pas remplis !';
            }
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }
// Addpost 
    else if($_GET['action']=='addPost' ) {
        if (!empty($_POST['title']) && !empty($_POST['content']) ) {
                addPost($_POST['title'] , $_POST['content']);
            }
        else {
            addPost();
            }
        }
  
                 
        // ChangePost , DeletePost, signIn , SignalComment, DeleteComment, listSignaledComments
    
        else if($_GET['action']=='signalComment' ){
            if (isset($_GET['id']))
            {
                signalCommment($_GET['id'],2);
            }
            else { 
                throw new Exception('Aucun identifiant de commentaire selectionné') ;
            }
    }
        else if($_GET['action']=  'SignIn')
                {signIn();}
    

    }
    else{
        listPosts();
        }
}
catch(Exception $e) { 
    echo 'Erreur :  ' . $e->getMessage();
}

       /* else if($_GET['action']=='changePost') à fairr
        
        else if($_GET['action']= 'deletePost' ) 
            if (isset($_GET['id']) && $_GET['id'] > 0) { 
                deletePost($_GET['id]'])
            }
            else {
                throw Exception('Aucun identifiant de billet envoyé') 
            }
             

        else if($_GET['action']= 'deleteComment'

            if (isset($_GET['commentId']) && $_GET['commentId'] > 0) { 
                deleteComment($_GET['commentId]'])
            }
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé') 
            }
             


       
        else if($_GET['action']= 'addComment' )
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['postId'], $_POST['author'], $_POST['comment']);
                }
                else {
                    throw  Exception('Tous les champs ne sont pas remplis !'); 
            }
            else {
                throw  Exception('Aucun identifiant de billet envoyé');
            }
             

        
             


        else if($_GET['action']= 'signalComment' )
            
            if (isset($_GET['commentId']))
            {
                signalComment($_GET['commentId']);
            }
            else { 
                throw new Exception('Aucun identifiant de commentaire selectionné') 
            }

*/
                     
