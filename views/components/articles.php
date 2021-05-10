<main class="main">
  <?php if(!empty($db)):
    foreach($db as $article):
  ?>
  <article class="main__post post">
    <div class="post__box">
      <header class="post__header">
        <section class="post__header-title">
          <h2 class="post__title">
            <a class="post__title-link" href="" ><?php echo $article['name']?></a>
          </h2>
          <p class="post__title-description">
              <?php echo $article['descriprion']?>
          </p>
        </section>
        <section class="post__meta">
          <time class="post__meta-published" datetime="<?php echo implode('-', array_reverse(explode('.',$article['date'])));?>"><?php echo $article['date']?></time>
          <a class="post__meta-author" href="">
            <span class="post__meta-name"><?php echo $article['author']?></span>
            <img class="post__meta-image" src="<?php echo $article['avatar']?>" alt="Картинка">
          </a>
        </section>
      </header>
      <a class="post__image-link" href="">
        <img class="post__image" src="<?php echo $article['image']?>" alt="Картинка">
      </a>
      <p class="post__descripton">
          <?php echo $article["short-post"] ?>
      </p>
      <footer class="post__footer">
        <a class="post__read">
          Читать далее
        </a>
        <ul class="post__stats">
          <li class="post__stats-item">
            <a class="post__stats-link" href=""><i class="fas fa-circle <?php echo strtolower($article['theme'])?>-icon"></i><?php echo $article['theme']?></a>
          </li>
          <li class="post__stats-item">
            <a class="post__stats-link" href=""><i class="fas fa-heart <?php echo $article['liked'] ? 'post__stats-like' : ''?>"></i><?php echo $article['likes']?></a>
          </li>
          <li class="post__stats-item">
            <a class="post__stats-link" href=""><i class="fas fa-comments <?php echo $article['commented'] ? 'post__stats-comment' : ''?>"></i><?php echo $article['comments']?></a>
          </li>
        </ul>
      </footer>
    </div>
  </article>
  <?php
    endforeach;
    endif;
  ?>
  <?php include_once './views/components/pagination.php'?>
</main>