<section class="sidebar__popular">
  <h3 class="sidebar__popular-title">Популярные посты</h3>
  <?php
    $populars = $posts->topByPopular();
    if(!empty($populars)):
  ?>
  <ul class="sidebar__popular-posts">
    <?php
    foreach($populars as $popular):?>
      <li class="sidebar__popular-post">
        <div class="sidebar__popular-link post-link">
          <header class="post-link__header">
            <a class="post-link__title-a" href="">
              <h4 class="post-link__title"><?php echo $popular->getTitle()?></h4>
            </a>
            <time class="post-link__published" datetime="<?php echo implode('-', array_reverse(explode('.', $popular->getDate())));?>"><?php echo $popular->getDate()?></time>
            <a class="post-link__author" href="">
              <img class="post-link__author-photo" src="<?php echo $popular->getAvatar()?>" alt="Фото">
            </a>
          </header>
          <a class="post-link__image-a" href="">
            <img class="post-link__image" src="<?php echo $popular->getImage()?>" alt="Картинка">
          </a>
        </div>
      </li>
      <?php endforeach?>
  </ul>
  <?php endif?>
</section>