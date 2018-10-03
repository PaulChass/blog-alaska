
  <?php $title= "Page d'accueil";?> 
  <?php $blogTitle = $title;?>
  <?php ob_start(); ?>
      

<?php 
$count = 0;
while ($post= $lposts->fetch())
{
?>
          <div class="blog-post">
            <h2 class="blog-post-title"> <a href="index.php?action=post&amp;id=<?= $post['id'] ?>" >
            <?= htmlspecialchars($post['title']);?></a>
        </h2>
            <p class="blog-post-meta"> le 
            <?= $post['updateDate_fr']?></p>
            <p><?= $post['content'] ?></p>



            
              
          </div><!-- /.blog-post -->
<?php }  $lposts->closeCursor();

?> 
     <?php $blogMain = ob_get_clean(); ?>


<?php require('template.php'); ?>

    