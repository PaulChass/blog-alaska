<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title> Billet Simple pour L'Alaska</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="Public/css/blog.css" rel="stylesheet">
  </head>
  <body>
 
    <div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
            <a class="text-muted" href="index.php?action=signUp"><?php if(isUser()==FALSE){
              echo 'S\'inscrire';
            }
            else {echo 'Utilisateur :  '.$_SESSION['username'];}
            ?>

          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="index.php"> Billet Simple pour l'Alaska </a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
            
            <?php
            
             if(isset($_SESSION['userType'])){
              ?><a class="btn btn-sm btn-outline-secondary" href="index.php?action=signOut"> <?php  echo 'Deconnexion'; 
            }
            else if(!isset($_SESSION['userType'])){?>
            <a class="btn btn-sm btn-outline-secondary" href="index.php?action=signIn">
            <?php echo 'Connexion';}?></a>
          </div>
        </div>
      </header>
       

        <div class="image">   
        <p>     
          <img src="Public/alaska.png" class="img-fluid" id="wide-img" alt="Responsive image" >
       </p>
       </div>




    <main role="main" class="container">
      <div class="row">
        <div class="col-md-8 blog-main">
          <h2 class="pb-3 mb-4 font-italic border-bottom">
            <?=  $blogTitle ?>
          </h2>

          <div class="blog-post">
            <?= $blogMain ?>
          </div>

        </div><!-- /.blog-main -->

        <aside class="col-md-4 blog-sidebar">
          <div class="p-4 mb-4 bb rounded">
            <h4 class="font-italic">A propos de</h4>
            <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div>

          <div class="p-4 mb-3 list ">
            <h4 class="font-italic">Liste des episodes</h4>
            <ol class="list-unstyled mb-0">
              <li><a href="index.php?action=listPosts">Tous!</a></li>
             <?php $i=1;while($post= $posts->fetch())
             {
                ?>
                <li><a href="index.php?action=post&id=<?= $post['id'];?>">Episode <?php echo $i;$i++;?></a>   <?= htmlspecialchars($post['title'])?> </li>
             <?php }$posts->closeCursor();?>
             <?php if(isAdmin()== TRUE)
                {?>
                <li><a href="index.php?action=addPost">Nouvel Episode</a></li><?php } ?>
            </ol>
          </div>

          
        </aside><!-- /.blog-sidebar -->

      </div><!-- /.row -->

           </main><!-- /.container -->

    <footer class="blog-footer">
      
      <p>
      <?php if(isAdmin()== TRUE)
                {?>
        <a href="index.php?action=dashboard" class="p-4"> Dashboard </a><?php
        } ?>
        <a href="#" class="p-4"> Revenir au haut de page</a>
        <a href="index.php" class="p-4">  Page d'accueil</a>
      </p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/vendor/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/vendor/holder.min.js"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
  </body>
</html>
