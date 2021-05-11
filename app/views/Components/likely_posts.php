<section class="sidebar__likely">
  <h3 class="sidebar__likely-title">Понравившиеся посты</h3>
  <?php
    $liked = $posts->topByLiked();
    if(!empty($liked)):
  ?>
  <ul class="sidebar__likely-posts">
      <?php foreach ($liked as $like): ?>
      <li class="sidebar__likely-post">
        <div class="sidebar__likely-link post-link">
          <header class="post-link__header">
            <a class="post-link__title-a" href="">
              <h4 class="post-link__title"><?php echo $like->getTitle()?></h4>
            </a>
            <time class="post-link__published" datetime="<?php echo implode('-', array_reverse(explode('.',$like->getDate())));?>"><?php echo $like->getDate()?></time>
          </header>
          <a class="post-link__image-a">
            <img class="post-link__image" src="<?php echo $like->getImage()?>" alt="Картинка">
          </a>
        </div>
      </li>
      <?php endforeach ?>
  </ul>
  <?php endif ?>
</section>