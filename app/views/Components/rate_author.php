<section class="sidebar__rate">
  <h3 class="sidebar__rate-title">Рейтинг авторов</h3>
  <?php
    $authors = $users->topByRate();
    if(!empty($authors)):
  ?>
  <ul class="sidebar__rate-authors">
    <?php foreach($authors as $author):?>
    <li class="sidebar__rate-author">
      <div class="sidebar__rate-author-box author">
        <header class="author__header">
          <a class="author__link">
            <h4 class="author__name"><?php echo $author->getLogin()?></h4>
          </a>
          <a class="author__rate"><i class="fas fa-heart"></i> <?php echo $author->getLikes()?></a>
        </header>
        <a class="author-link__photo">
          <img class="author-link__image" src="<?php echo $author->getAvatar()?>" alt="Картинка">
        </a>
      </div>
    </li>
    <?php endforeach ?>
  </ul>
  <?php endif ?>
</section>