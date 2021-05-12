<section class="sidebar__popular">
  <h3 class="sidebar__popular-title">Популярные посты</h3>
    <?php
      if(!empty($populars)):
    ?>
    <ul class="sidebar__popular-posts">
      <?php
      foreach($populars as $popular):?>
      <li class="sidebar__popular-post">
        <div class="sidebar__popular-link post-link">
          <header class="post-link__header">
            <a class="post-link__title-a" href="/post/<?=$popular->getAlias()?>">
              <h4 class="post-link__title"><?php echo $popular->getTitle()?></h4>
            </a>
            <time class="post-link__published" datetime="<?=explode(' ', $popular->getDate())[0]?>"><?=implode( '.' ,array_reverse(explode('-', explode(' ', $popular->getDate())[0])))?></time>
            <a class="post-link__author" href="/profile/<?=strtolower($popular->getAuthor())?>">
              <img class="post-link__author-photo" src="data:image/png;base64,<?=base64_encode($popular->getAvatar());?>" alt="Фото">
            </a>
          </header>
          <a class="post-link__image-a" href="/post/<?=$popular->getAlias()?>">
            <img class="post-link__image" src="data:image/png;base64,<?=base64_encode($popular->getImage());?>" alt="Картинка">
          </a>
        </div>
      </li>
      <?php endforeach?>
    </ul>
    <?php
    else:
        echo '<p class="empty__post empty__post-block">Постов нет!</p>';
    endif;
    ?>
</section>