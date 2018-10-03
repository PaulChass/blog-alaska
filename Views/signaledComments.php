<?php $blogTitle= "Liste des commentaires signalés";
ob_start();

while ($signaledComment = $signaledComments->fetch()) {

    if(!isset($lastPost) || $signaledComment['postId'] != $lastPost)
    {?>
        <div class="p-3" style="font-weight:bold;text-align:center;border-bottom:1px solid grey;">
            <?= htmlspecialchars($signaledComment['title']); ?>
            </div>
        <div class="comment p-2 col-12" style="justify-content:space-between;" id="comment"> 
            <?php echo $signaledComment['content'];?>
            <form  action="index.php?action=deleteComment&amp;id=<?=$comment['id']?>" method="post">
                <button style="color:white;"> Supprimer</button></form>
            </div>
            
   <?php }
    else{?>
           <div class="comment p-2 col-12" style="justify-content:space-between;" id="comment"> 
           <?php echo $signaledComment['content'];?>
           <form  action="index.php?action=deleteComment&amp;id=<?=$comment['id']?>" method="post">
                <button style="color:white;"> Supprimer</button></form>
            </div>
        <?php }
    $lastPost=$signaledComment['postId'];
}
$signaledComments->closeCursor();
$blogMain = ob_get_clean();
require "adminView.php";?>