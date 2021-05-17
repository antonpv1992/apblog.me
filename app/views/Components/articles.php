<main class="main">
  <?php 
    if(!empty($articles)):
    foreach($articles as $article):
  ?>
  <article class="main__post post">
    <div class="post__box">
      <header class="post__header">
        <section class="post__header-title">
          <h2 class="post__title">
            <a class="post__title-link" href="/post/<?=$article->getAlias()?>" ><?=$article->getTitle()?></a>
          </h2>
          <p class="post__title-description">
          <?=$article->getDescription()?>
          </p>
        </section>
        <section class="post__meta">
          <time class="post__meta-published" datetime="<?=explode(' ', $article->getDate())[0]?>"><?=implode( '.' ,array_reverse(explode('-', explode(' ', $article->getDate())[0])))?></time>
          <a class="post__meta-author" href="/profile/<?=strtolower($article->getAuthor())?>">
            <span class="post__meta-name"><?=$article->getAuthor()?></span>
            <img class="post__meta-image" src="data:image/png;base64,<?=base64_encode($article->getAvatar());?>" alt="Картинка">
          </a>
        </section>
      </header>
      <a class="post__image-link" href="/post/<?=$article->getAlias()?>">
        <img class="post__image" src="data:image/png;base64,<?=base64_encode($article->getImage());?>" alt="Картинка">
      </a>
      <p class="post__descripton">
        <?=$article->getShortText()?>
      </p>
      <footer class="post__footer">
        <a class="post__read" href="/post/<?=$article->getAlias()?>">
          Читать далее
        </a>
        <ul class="post__stats">
          <li class="post__stats-item">
            <a class="post__stats-link" href="/posts/<?=strtolower($article->getTheme())?>"><i class="fas fa-circle <?=strtolower($article->getTheme())?>-icon"></i><?=strtoupper($article->getTheme())?></a>
          </li>
          <li class="post__stats-item">
            <a class="post__stats-link <?=isset($_SESSION['user']) ? 'post__stats-heart' : ''?>"><i class="fas fa-heart <?=$article->isLiked() ? 'post__stats-like' : ''?>" <?=isset($_SESSION['user']) ? "data-like=" . $article->getId() . "-" . $article->getUid() : "" ?>></i><?=$article->getLikes()?></a>
          </li>
          <li class="post__stats-item">
            <a class="post__stats-link"><i class="fas fa-comments <?=$article->isCommented() ? 'post__stats-comment' : ''?>"></i><?=$article->getComments()?></a>
          </li>
        </ul>
      </footer>
    </div>
  </article>
  <?php 
    endforeach;
    else:
      echo '<p class="empty__post">Постов нет!</p>';
    endif;
    include_once '../app/views/Components/pagination.php'
  ?>
</main>