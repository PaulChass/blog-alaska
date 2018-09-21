<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title> <?= $title ?></title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
   
    <link href="Public/css/blog.css" rel="stylesheet">
   
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
     <link href="Public/blog.css" rel="stylesheet">
       </head>

       
<body>
 <div class="container">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
            
          </div>
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="index.php"> Billet Simple pour l'Alaska </a>
          </div>
          <div class="col-4 d-flex justify-content-end align-items-center">
            <p>Administrateur</p>
          </div>
        </div>
      </header>

       
        <div class="image">   
        <p>     
          <img src="Public/alaska.png" class="img-fluid" id="wide-img" alt="Responsive image" >
       </p>
       </div>
 
     <main role="main" class="container">
        
          <h3 class="pb-3 font-italic center border-bottom">
            <?=  $blogTitle ?>
          </h3>

          <div class="blog-post pb-10">
            <?= $blogMain ?>
          </div>
     	
   

    </main><!-- /.container -->

    <footer class="blog-footer">
      
    <div class="row flex-nowrap justify-content-around align-items-center">
    <a class="p-4 justify-content-" href="#">Dashboard</a>
    <a href="index.php" class="p-4 justify-content-between">  Page d'accueil</a>
    </div> 
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
     <!-- Script TinyMCE -->
     <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
    <script>
      tinymce.init({
      selector: '#content'
      });
    </script>
  </body>
</html>

