<?php $title= $post['title'];
$blogTitle =  $title;
ob_start(); ?>
<div class="blog-post">
            <h2 class="blog-post-title"> 
            
        </h2>
            <p class="blog-post-meta"> le 
            <?= $post['updateDate_fr']?></p>
            <p class="blog-post-meta"><?= ($post['content']) ?></p>
           
           
           
            <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" value="Envoyer"/>
    </div>
</form>
            </form>
           
          <!-- /.blog-post  -->
          <?php while ($comment=$comments->fetch()) 
          {
	          ?>
          <p><?= htmlspecialchars($comment['content']) ?>
          <form  action="index.php?action=signalComment&amp;id=<?= $comment['id'] ?>" method="post">
          
          
   <button> Signaler</button></p>
</form>
		  
          
          <?php } $comments->closeCursor();
?> </div>
    <?php $blogMain= ob_get_clean(); ?>
        
<?php require("template.php");?>