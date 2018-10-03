<?php $blogTitle= "Liste des commentaires likés";
ob_start();

while ($likedComment = $likedComments->fetch()) {

    if(!isset($lastPost) || $likedComment['postId'] != $lastPost)
    {?>
        <div class="p-3" style="font-weight:bold;text-align:center;border-bottom:1px solid grey;">
            <?= htmlspecialchars($likedComment['title']); ?>
            </div>
        <div class="comment p-2 col-12" style="justify-content:space-between;" id="comment"> 
            <?php echo $likedComment['content'];?>
            <form  action="index.php?action=deleteComment&amp;id=<?=$comment['id']?>" method="post">
                <button style="color:white;"> Supprimer</button></form>
            </div>
            
   <?php }
    else{?>
           <div class="comment p-2 col-12" style="justify-content:space-between;" id="comment"> 
           <?php echo $likedComment['content'];?>
           <form  action="index.php?action=deleteComment&amp;id=<?=$comment['id']?>" method="post">
                <button style="color:white;"> Supprimer</button></form>
            </div>
        <?php }
    $lastPost=$likedComment['postId'];
}
$likedComments->closeCursor();
$blogMain = ob_get_clean();
require "adminView.php";?>