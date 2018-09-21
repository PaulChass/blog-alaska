<?php $blogTitle= "Modifier l'épisode";

ob_start();?>
  <form method="post" id="changePost" action="index.php?action=changePost&id=<?= $post['id']?>">
    <label for title> Titre de l'épisode</label>  <input type="textarea" name="title" id="title" value="<?= $post['title'] ?>"> </textarea></p>
    <input type="textarea" name="content" id="content" value="<?= htmlspecialchars($post['content']);?>"></textarea>
    <p class=text-center>
    <input class="btn btn-sm btn-outline-secondary"  type="submit" value="Envoyer" />
    </p>
  </form>
  
<?php $blogMain = ob_get_clean();?>
<?php require "adminView.php";?>


 