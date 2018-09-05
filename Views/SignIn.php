<?php $title= "Authentification";?> 
  <?php $blogTitle = $title;?>
  <?php ob_start(); ?>
<html lang="en">
  <head>
    <!-- Custom styles for this template -->
    <link href="Public/css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin">
      <h1 class="h3 mb-3 font-weight-normal">Se connecter</h1>
      <label for="inputEmail" class="sr-only">addresse email</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Mot de Passe</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Se souvenir de moi
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
    </form>
  </body>
</html>
<?php $blogMain = ob_get_clean(); ?>


<?php require('adminView.php'); ?>      