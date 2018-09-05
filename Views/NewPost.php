<?php $title= "Nouvel Episode";?> 
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
<h1>Nouvel Episode</h1>
  <form method="post" action="index.php?action=addPost"><p>
    <label for title> Titre de l'épisode</label>  <input type="textarea" name="title" id="title"></textarea></p>
    <input type="textarea" name="content" id="content"></textarea>
    <input type="submit" value="Envoyer" />
  </form>
</body>
</html>
 