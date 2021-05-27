<?php if (isset($_SESSION['user'])): ?>
<section class="sidebar__likely">
  <h3 class="sidebar__likely-title">Понравившиеся посты</h3>
  <?php 
    if (!empty($liked)):
  ?>
  <ul class="sidebar__likely-posts">
    <?php foreach ($liked as $like):
    ?>
    <li class="sidebar__likely-post">
      <div class="sidebar__likely-link post-link">
        <header class="post-link__header">
          <a class="post-link__title-a" href="/post/<?=$like->getAlias()?>">
            <h4 class="post-link__title"><?=$like->getTitle()?></h4>
          </a>
          <time class="post-link__published" datetime="<?=explode(' ', $like->getDate())[0]?>"><?=implode( '.' ,array_reverse(explode('-', explode(' ', $like->getDate())[0])))?></time>
        </header>
        <a class="post-link__image-a" href="/post/<?=$like->getAlias()?>">
          <img class="post-link__image" src="data:image/png;base64,<?=base64_encode($like->getImage());?>" alt="Картинка">
        </a>
      </div>
    </li>
    <?php endforeach ?>
  </ul>
  <?php 
    else:
      echo '<p class="empty__post empty__post-block">Постов нет!</p>';
    endif;
  ?>
</section>
<?php endif; ?>