<main class="main">
  <?php
    $allPosts = $posts->getPosts();
    if(!empty($posts)):
        foreach($allPosts as $article):
  ?>
  <article class="main__post post">
    <div class="post__box">
      <header class="post__header">
        <section class="post__header-title">
          <h2 class="post__title">
            <a class="post__title-link" href="" ><?php echo $article->getTitle()?></a>
          </h2>
          <p class="post__title-description">
              <?php echo $article->getDescription()?>
          </p>
        </section>
        <section class="post__meta">
          <time class="post__meta-published" datetime="<?php echo implode('-', array_reverse(explode('.',$article->getDate())));?>"><?php echo $article->getDate()?></time>
          <a class="post__meta-author" href="">
            <span class="post__meta-name"><?php echo $article->getAuthor()?></span>
            <img class="post__meta-image" src="<?php echo $article->getAvatar()?>" alt="Картинка">
          </a>
        </section>
      </header>
      <a class="post__image-link" href="">
        <img class="post__image" src="<?php echo $article->getImage()?>" alt="Картинка">
      </a>
      <p class="post__descripton">
          <?php echo $article->getShortText()?>
      </p>
      <footer class="post__footer">
        <a class="post__read">
          Читать далее
        </a>
        <ul class="post__stats">
          <li class="post__stats-item">
            <a class="post__stats-link" href=""><i class="fas fa-circle <?php echo strtolower($article->getTheme())?>-icon"></i><?php echo $article->getTheme()?></a>
          </li>
          <li class="post__stats-item">
            <a class="post__stats-link" href=""><i class="fas fa-heart <?php echo $article->isLiked()? 'post__stats-like' : ''?>"></i><?php echo $article->getLikes()?></a>
          </li>
          <li class="post__stats-item">
            <a class="post__stats-link" href=""><i class="fas fa-comments <?php echo $article->isCommented() ? 'post__stats-comment' : ''?>"></i><?php echo $article->getComments()?></a>
          </li>
        </ul>
      </footer>
    </div>
  </article>
  <?php
    endforeach;
    endif;
  ?>
  <?php include_once '../app/views/Components/pagination.php'?>
</main>