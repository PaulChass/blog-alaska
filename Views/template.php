<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="style.css" rel="stylesheet" /> 
    </head>
        
    <body><?php
while ($data= $posts->fetch())
{
?>
    <div class="news">
        
            <?= htmlspecialchars($data['title']);
        }
$posts->closeCursor();?>
</div>
    </body>
</html>