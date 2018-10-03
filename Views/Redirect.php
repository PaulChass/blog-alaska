<?php $title= "Redirection";?> 
  <?php $blogTitle = $title;?>
  <?php ob_start(); ?>
<html lang="en">
  <head>

    <!-- Custom styles for this template -->
    
 
<link href="Public/css/blog.css" rel="stylesheet">
  </head>

  <body>
  <h4 class="err center">
  <?= $e ?></h4>
  <div class="loader center"> 
   </div>
   <h3 class="center">  Redirection en cours <br/>
   Veuillez patientez quelques secondes... </h3>

  </body>
</html>
<?php $blogMain = ob_get_clean(); ?>


<?php require('adminView.php'); ?>      
<?php header( "refresh:2;url=index.php?action=$action" );?>