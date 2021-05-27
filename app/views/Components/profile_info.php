<section class="profile__main-info">
<div class="profile__avatar-box">
  <img class="profile__avatar" src="data:image/png;base64,<?=base64_encode($user->getAvatar());?>" alt="Аватар">
  <?php 
    if ($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
  ?>
  <form class="profile__change" enctype="multipart/form-data" method="post">
    <label class="profile__change-avatar"> Изменить фото
      <input class="profile__input-hidden" type="file">
    </label>
  </form>
  <?php endif ?>
</div>
<ul class="profile__info">
  <li class="profile__info-item">
    <span class="profile__login-name">Логин:</span>
    <h3 class="profile__login-value"><?=$user->getLogin()?></h3>
  </li>
  <li class="profile__info-item">
    <span class="profile__item-name">Дата Рождения:</span>
    <time class="profile__item-value" datetime="<?=$user->getBirthday()?>"><?=implode( '.' ,array_reverse(explode('-', $user->getBirthday())))?></time>
  </li>
  <li class="profile__info-item">
    <span class="profile__item-name">Пол:</span>
    <span class="profile__item-value">
    <?php 
      if ($user->getSex() === 'man') {
        echo 'Мужской';
      } else if ($user->getSex() === 'woman') {
        echo 'Женский';
      } else {
        echo '';
      }
    ?></span>
  </li>
  <?php 
    if ($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
  ?>
  <li class="profile__info-item">
    <span class="profile__item-name">Почта:</span>
    <span class="profile__item-value"><?=$user->getEmail()?></span>
  </li>
  <?php endif ?>
</ul>
</section>