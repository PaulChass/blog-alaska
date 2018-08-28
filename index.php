<?php

require('Controllers/frontend.php');
require('Controllers/backend.php');

try { 
   
        if($_GET['action']= 'listPosts')
            listPosts();
             
    

        else if($_GET['action']= 'post')
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
             }   
             else {
               throw new Exception('Aucun identifiant de billet envoyé');
             }
             
    
        else if($_GET['action']= 'addPost' )
            if (!empty($_POST['publishDate']) && !empty($_POST['title']) && !empty($_POST['id'])  ) {
                    addPost($_GET['id'],  $_POST['content'] , $_POST['publishDate']);
                }
            else {
                throw new Exception('Tous les champs ne sont pas remplis !');
                }
                 
       
       /* else if($_GET['action']= 'changePost') à fairr
        
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
             

        else if($_GET['action']=  'SignIn')
                if (!empty($_POST['username'] && !empty($_POST['password'])){
                    signIn($_POST('username'), $_POST('password') );
                }
                else {
                    throw Exception('Tous les champs ne sont pas remplis !'); 
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
        else{
            listPosts();
        }
    }
        
        
catch(Exception $e) { 
    echo 'Erreur ) ' . $e->getMessage();
}
