<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Dashboard </title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="Public/css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Blog Billet Simple pour l'Alaska</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="index.php">Se deconnecter</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2">
          <nav class=" d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link active" href="#">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span data-feather="file"></span>
                    Commentaires Signalés
                  </a>
                </li>
                
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span data-feather="file"></span>
                    Liste des Posts
                  </a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      
        <div class="col-10 col-md-10">       
          <img src="Public/alaska.png" class="img-fluid" id="wide-img" alt="Responsive image" > 
          <h2 class="pb-3 mb-4 font-italic border-bottom">Dashboard </h2>
            <div class="row flex-wrap justify-content-around "> 
                <div class="data row p-3">
                    <p class="dataItem"> Episodes publiés:</p>
                    <p class="dataValue"><?=$countPosts?></p>
                </div>
                <div class="data row p-3">
                    <p class="dataItem">Commentaires postés :</p>
                    <p class="dataValue"> <?=$countComments ?></p>
                </div>
            </div>
            <div class="row flex-wrap justify-content-around"> 
                <div class="data p-3">
                    <p class="dataItem"> Commentaires "likés" :</p>
                    <p class="dataValue"><?=$countLikedComments?></p>
                </div>
                <div class="data p-3 row">
                    <p class="dataItem"> Commentaires signalés :</p>
                    <p class="dataValue"> <?=$countSignaledComments;?></p>
                </div>
            </div>
        

        <h2 class="pb-3 mb-4 font-italic border-bottom">Nouvel Episode</h2>
            <form method="post" action="index.php?action=addPost"><p>
                <label for title> Titre de l'épisode</label>  <input type="textarea" name="title" id="title"></textarea></p>
                <input type="textarea" name="content" id="content"></textarea> 
                <p class="center"> 
                <input class="btn below col-2 btn-sm btn-outline-secondary " type="submit" value="Envoyer" />
                </p>
            </form>
        </div>
        
        
   
     </div>
    
     
    


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
    <script>
      tinymce.init({
      selector: '#content'
      });
    </script>
  </body>
</html>
