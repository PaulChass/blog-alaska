<?php


function isAdmin()
{
    if(isset($_SESSION['userType'])  &&  $_SESSION['userType']=='admin'){
        return TRUE;
    }
    else return FALSE;
}

function isUser()
{
    if(isset($_SESSION['userType'])){
        return TRUE;
    }   else return FALSE;
}

function showError($e,$action=null)
{
    if(isset($action)){
        require('Views/Redirect.php');    
    }   else    {
        $action='listPosts';
        require('Views/Redirect.php');
    }
}