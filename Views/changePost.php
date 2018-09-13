<?php $title= "Modifier l'épisode";?> 
<!DOCTYPE html>
<html>
<head>
  <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
  <script>
  tinymce.init({
    selector: '#content'
  });
  </script>
</head>
<body>
<h1><?=  $title;?></h1>
  <form method="post" action="index.php?action=changePost&id=<?= $post['id']?>">
    <label for title> Titre de l'épisode</label>  <input type="textarea" name="title" id="title" value="<?= $post['title'] ?>"> </textarea></p>
    <input type="textarea" name="content" id="content" value="<?= htmlspecialchars($post['content']);?>"></textarea>
    <input type="submit" value="Envoyer" />
  </form>
</body>
</html>
 