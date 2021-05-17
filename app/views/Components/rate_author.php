<section class="sidebar__rate">
  <h3 class="sidebar__rate-title">Рейтинг авторов</h3>
  <?php 
    if(!empty($authors)):
  ?>
  <ul class="sidebar__rate-authors">
    <?php 
      foreach($authors as $author):
    ?>
    <li class="sidebar__rate-author">
      <div class="sidebar__rate-author-box author">
        <header class="author__header">
          <a class="author__link" href="/profile/<?=strtolower($author->getLogin())?>">
            <h4 class="author__name"><?=$author->getLogin()?></h4>
          </a>
          <a class="author__rate"><i class="fas fa-heart"></i> <?=$author->getLikes();?></a>
        </header>
        <a class="author-link__photo" href="/profile/<?=strtolower($author->getLogin())?>">
          <img class="author-link__image" src="data:image/png;base64,<?=base64_encode($author->getAvatar());?>" alt="Картинка">
        </a>
      </div>
    </li>
    <?php endforeach ?>
  </ul>
  <?php 
    else:
      echo '<p class="empty__post empty__post-block">Авторов нет!</p>';
    endif;
  ?>
</section>