
  <?php $title= "Page d'accueil";?> 
  <?php $blogTitle = $title;?>
  <?php ob_start(); ?>
      

<?php 
$count = 0;
while ($post= $posts->fetch())
{
$count = $count + 1;
?>
          <div class="blog-post">
            <h2 class="blog-post-title"> 
            <?= htmlspecialchars($post['title']);?>
        </h2>
            <p class="blog-post-meta"> le 
            <?= $post['updateDate_fr']?></p>
            <p><?= $post['content'] ?></p>





<!-- formulaire de commentaire -->
           <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>
            </form>
            
           
          </div><!-- /.blog-post -->
<?php }  $posts->closeCursor();

?> 
     <?php $blogMain = ob_get_clean(); ?>


<?php require('template.php'); ?>

    <!--  <div class="container">
       NAVBAR>
      <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
          <a class="p-2 text-muted" href="#">World</a>
          <a class="p-2 text-muted" href="#">U.S.</a>
          <a class="p-2 text-muted" href="#">Technology</a>
          
        </nav>
      </div>
   

      <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
          <h1 class="display-4 font-italic">Dernier episode</h1>
          <p class="lead my-3">Le titre de l'épisode</p>
          <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">CLiquer ici pour le lire!</a></p>
        </div>
      </div>


      <div class="row mb-2">
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 shadow-sm h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">World</strong>
              <h3 class="mb-0">
                <a class="text-dark" href="#">Featured post</a>
              </h3>
              <div class="mb-1 text-muted">Nov 12</div>
              <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
              <a href="#">Continue reading</a>
            </div>
            <img class="card-img-right flex-auto d-none d-lg-block" post-src="holder.js/200x250?theme=thumb" alt="Card image cap">
          </div>
        </div>
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 shadow-sm h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-success">Design</strong>
              <h3 class="mb-0">
                <a class="text-dark" href="#">Post title</a>
              </h3>
              <div class="mb-1 text-muted">Nov 11</div>
              <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
              <a href="#">Continue reading</a>
            </div>
            <img class="card-img-right flex-auto d-none d-lg-block" post-src="holder.js/200x250?theme=thumb" alt="Card image cap">
          </div>
        </div>
      </div>
    </div>
-->