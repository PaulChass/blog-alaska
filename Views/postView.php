<?php $title = $post['title'];
$blogTitle = $title;
ob_start();?>

<div class="blog-post">
    <p  class="blog-post-meta ">    
   
    <p class="blog-post-meta"> le
    <?=$post['updateDate_fr']?></p>
    <?php if(isset($_SESSION['userType']) && $_SESSION['userType']=='admin'){ ?>
        <a href="index.php?action=changePost&id=<?=$post['id']?>"> (modifier)</a><?php 
        } ?>
    <p class="blog-post-meta"><?=($post['content'])?></p>
</div>


<div class="blog-comment">
    <h4 class="pb-6 mb-4  font-italic border-top"> Commentaires </h4>
    <form action="index.php?action=addComment&amp;id=<?=$post['id']?>" method="post">
        <div id="commentbar">
          <textarea id="yourcomment" name="comment" placeholder=" Entrer votre commentaire ..."></textarea>
            <input class="btn btn-sm btn-outline-secondary " type="submit" value="Envoyer"/>
        </div>
    </form>
        <?php while ($comment = $comments->fetch()) {
    if( $comment['postId']==$post['id']){?>
        <div id="comment">
            <p><?php if($comment['username']=='161EXyUcyE.vo'){?>
                <strong>Anonyme </strong>
                <?php 
                } 
                else {
                ?>
                <strong> <?php echo(htmlspecialchars($comment['username'])) ;
                } ?> </strong>
                

                  ( le <?=htmlspecialchars($comment['publishDate_fr'])?> ) <?=htmlspecialchars($comment['content'])?></p>
                <?php if(isset($_SESSION['userType']))
            {?>
                <form  action="index.php?action=signalComment&amp;id=<?=$comment['id']?>" method="post">
                <button class="fas fa-exclamation"></button></form>

                <form  action="index.php?action=likeComment&amp;id=<?=$comment['id']?>" method="post">
                <button class="fas fa-thumbs-up"></button></form>
                <?php if($_SESSION['userType']=='admin')
                {?>
                <form  action="index.php?action=deleteComment&amp;id=<?=$comment['id']?>" method="post">
                <button> Supprimer</button></form><?php
                }
                }?>
        </div>
        <?php }
        }
$comments->closeCursor();
?> </div>
    <?php $blogMain = ob_get_clean();?>

<?php require "template.php";?>