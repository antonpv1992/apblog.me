<section class="profile__personal">
  <ul class="profile__list">
    <li class="profile__item">
      <span class="profile__item-name">
        Имя
      </span>
      <div class="profile__item-value">
        <div class="profile__form">
          <span class="profile__item-link">
            <?php 
              if($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
            ?>
            <input class="profile__field" type="text" name="name" value="<?=$user->getName()?>">
          </span>
          <span class="profile__edit"><i class="fas fa-pencil-alt"></i></span>
          <?php
            else:
          ?>
            <p class="profile__field"><?=$user->getName()?></p>
          </span>
          <?php endif ?>
        </div>
      </div>
    </li>
    <li class="profile__item">
      <span class="profile__item-name">
        Фамилия
      </span>
      <div class="profile__item-value">
        <div class="profile__form">
          <span class="profile__item-link">
            <?php 
              if($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
            ?>
            <input class="profile__field" type="text" name="surname" value="<?=$user->getSurname()?>">
          </span>
          <span class="profile__edit"><i class="fas fa-pencil-alt"></i></span>
          <?php
            else:
          ?>
            <p class="profile__field"><?=$user->getSurname()?></p>
          </span>
          <?php endif ?>
        </div>
      </div>
    </li>
    <li class="profile__item">
      <span class="profile__item-name">
        Дата рождения
      </span>
      <div class="profile__item-value">
        <div class="profile__form">
          <span class="profile__item-link">
           <?php 
              if($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
            ?>
            <input class="profile__field" type="date" name="birthday" value="<?=$user->getBirthday()?>">
          </span>
          <span class="profile__edit"><i class="fas fa-pencil-alt"></i></span>
          <?php
            else:
          ?>
            <p class="profile__field" datetime="<?=explode(' ', $user->getBirthday())[0]?>"><?=implode( '.' ,array_reverse(explode('-', explode(' ', $user->getBirthday())[0])))?></p>
          </span>
          <?php endif ?>
        </div>
      </div>
    </li>
    <?php 
      if($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
    ?>
    <li class="profile__item">
      <span class="profile__item-name">
        Телефон
      </span>
      <div class="profile__item-value">
        <div class="profile__form">
          <span class="profile__item-link">
            <input class="profile__field" type="text" name="phone" value="<?=$user->getPhone()?>">
          </span>
          <span class="profile__edit"><i class="fas fa-pencil-alt"></i></span>
        </div>
      </div>
    </li>
    <?php endif ?>
    <li class="profile__item">
      <span class="profile__item-name">
        Страна
      </span>
      <div class="profile__item-value">
        <div class="profile__form">
          <span class="profile__item-link">
            <?php 
              if($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
            ?>
            <input class="profile__field" type="text" name="country" value="<?=$user->getCountry()?>">
          </span>
          <span class="profile__edit"><i class="fas fa-pencil-alt"></i></span>
          <?php
            else:
          ?>
            <p class="profile__field"><?=$user->getCountry()?></p>
          </span>
          <?php endif ?>
        </div>
      </div>
    </li>
    <li class="profile__item">
      <span class="profile__item-name">
        Город
      </span>
      <div class="profile__item-value">
        <div class="profile__form">
          <span class="profile__item-link">
            <?php 
              if($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
            ?>
            <input class="profile__field" type="text" name="city" value="<?=$user->getCity()?>">
          </span>
          <span class="profile__edit"><i class="fas fa-pencil-alt"></i></span>
          <?php
            else:
          ?>
            <p class="profile__field"><?=$user->getCity()?></p>
          </span>
          <?php endif ?>
        </div>
      </div>
    </li>
  </ul>
</section>
