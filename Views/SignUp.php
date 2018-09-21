<?php $title= "Créer un compte";?> 
  <?php $blogTitle = $title;?>
  <?php ob_start(); ?>
<html lang="en">
  <head>
    <!-- Custom styles for this template -->
    <link href="Public/css/signin.css" rel="stylesheet">
  </head>

<body class="text-center">
    <form method="post" class="form-signin" action="index.php?action=signUp">
      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Créer un compte</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="addresse mail" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Mot de Passe" required>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirmer le mot de passe" required>
      <label for="name" class="sr-only"> Nom d'utilisateur </label>
      <input type="name" id="username" name="username" class="form-control" placeholder="Nom d'utilisateur" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Se souvenir de moi
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
  </body>
  
</html>
<?php $blogMain = ob_get_clean(); ?>


<?php require('adminView.php'); ?>      