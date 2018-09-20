<?php $blogTitle= "Nouvel Episode";
$title="Nouvel Episode";


ob_start();?>
  <form method="post" action="index.php?action=addPost"><p>
    <label for title> Titre de l'épisode</label>  <input type="textarea" name="title" id="title"></textarea></p>
    <input type="textarea" name="content" id="content"></textarea>
    <div class="text-center">
    <input class="btn btn-sm btn-outline-secondary " type="submit" value="Envoyer" />
    </div>
  </form>

<?php $blogMain = ob_get_clean();?>
<?php require "adminView.php";?>
 