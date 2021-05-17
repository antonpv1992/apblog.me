<section class="profile__contacts">
  <ul class="profile__list">
    <li class="profile__item">
      <span class="profile__item-name">
        <i class="fas fa-globe"></i> Сайт
      </span>
      <div class="profile__item-value">
        <div class="profile__form">
          <span class="profile__item-link">
            <?php 
              if($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
            ?>
            <input class="profile__field" type="text" name="site" value="<?=$user->getSite()?>">
          </span>
          <span class="profile__edit"><i class="fas fa-pencil-alt"></i></span>
          <?php
            else:
          ?>
            <p class="profile__field"><?=$user->getSite()?></p>
          </span>
          <?php endif ?>
        </div>
      </div>
    </li>
    <li class="profile__item">
      <span class="profile__item-name">
        <i class="fab fa-telegram"></i> Телеграм
      </span>
      <div class="profile__item-value">
        <div class="profile__form">
          <span class="profile__item-link">
            <?php 
              if($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
            ?>
            <input class="profile__field" type="text" name="telegram" value="<?=$user->getTelegram()?>">
          </span>
          <span class="profile__edit"><i class="fas fa-pencil-alt"></i></span>
          <?php
            else:
          ?>
            <p class="profile__field"><?=$user->getTelegram()?></p>
          </span>
          <?php endif ?>
        </div>
      </div>
    </li>
    <li class="profile__item">
      <span class="profile__item-name">
        <i class="fab fa-viber"></i> Вайбер
      </span>
      <div class="profile__item-value">
        <div class="profile__form">
          <span class="profile__item-link">
            <?php 
              if($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
            ?>
            <input class="profile__field" type="text" name="viber" value="<?=$user->getViber()?>">
          </span>
          <span class="profile__edit"><i class="fas fa-pencil-alt"></i></span>
          <?php
            else:
          ?>
            <p class="profile__field"><?=$user->getViber()?></p>
          </span>
          <?php endif ?>
        </div>
      </div>
    </li>
    <li class="profile__item">
      <span class="profile__item-name">
        <i class="fab fa-whatsapp"></i> Whatsapp
      </span>
      <div class="profile__item-value">
        <div class="profile__form">
          <span class="profile__item-link">
            <?php 
              if($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
            ?>
            <input class="profile__field" type="text" name="whatsapp" value="<?=$user->getWhatsapp()?>">
          </span>
          <span class="profile__edit"><i class="fas fa-pencil-alt"></i></span>
          <?php
            else:
          ?>
            <p class="profile__field"><?=$user->getWhatsapp()?></p>
          </span>
          <?php endif ?>
        </div>
      </div>
    </li>
    <li class="profile__item">
      <span class="profile__item-name">
        <i class="far fa-comment"></i> Сигнал
      </span>
      <div class="profile__item-value">
        <div class="profile__form">
          <span class="profile__item-link">
            <?php 
              if($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
            ?>
            <input class="profile__field" type="text" name="signall" value="<?=$user->getSignal()?>">
          </span>
          <span class="profile__edit"><i class="fas fa-pencil-alt"></i></span>
          <?php
            else:
          ?>
            <p class="profile__field"><?=$user->getSignal()?></p>
          </span>
          <?php endif ?>
        </div>
      </div>
    </li>
    <li class="profile__item">
      <span class="profile__item-name">
        <i class="fas fa-video"></i> Зум
      </span>
      <div class="profile__item-value">
        <div class="profile__form">
          <span class="profile__item-link">
           <?php 
              if($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
            ?>
            <input class="profile__field" type="text" name="zoom" value="<?=$user->getZoom()?>">
          </span>
          <span class="profile__edit"><i class="fas fa-pencil-alt"></i></span>
          <?php
            else:
          ?>
            <p class="profile__field"><?=$user->getZoom()?></p>
          </span>
          <?php endif ?>
        </div>
      </div>
    </li>
    <li class="profile__item">
      <span class="profile__item-name">
        <i class="fab fa-skype"></i> Скайп
      </span>
      <div class="profile__item-value">
        <div class="profile__form">
          <span class="profile__item-link">
            <?php 
              if($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
            ?>
            <input class="profile__field" type="text" name="skype" value="<?=$user->getSkype()?>">
          </span>
          <span class="profile__edit"><i class="fas fa-pencil-alt"></i></span>
          <?php
            else:
          ?>
            <p class="profile__field"><?=$user->getSkype()?></p>
          </span>
          <?php endif ?>
        </div>
      </div>
    </li>
    <li class="profile__item">
      <span class="profile__item-name">
        <i class="fab fa-facebook"></i> Фейсбук
      </span>
      <div class="profile__item-value">
        <div class="profile__form">
          <span class="profile__item-link">
            <?php 
              if($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
            ?>
            <input class="profile__field" type="text" name="facebook" value="<?=$user->getFacebook()?>">
          </span>
          <span class="profile__edit"><i class="fas fa-pencil-alt"></i></span>
          <?php
            else:
          ?>
            <p class="profile__field"><?=$user->getFacebook()?></p>
          </span>
          <?php endif ?>
        </div>
      </div>
    </li>
    <li class="profile__item">
      <span class="profile__item-name">
        <i class="fab fa-twitter"></i> Твиттер
      </span>
      <div class="profile__item-value">
        <div class="profile__form">
          <span class="profile__item-link">
            <?php 
              if($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
            ?>
            <input class="profile__field" type="text" name="twitter" value="<?=$user->getTwitter()?>">
          </span>
          <span class="profile__edit"><i class="fas fa-pencil-alt"></i></span>
          <?php
            else:
          ?>
            <p class="profile__field"><?=$user->getTwitter()?></p>
          </span>
          <?php endif ?>
        </div>
      </div>
    </li>
    <li class="profile__item">
      <span class="profile__item-name">
        <i class="fab fa-vk"></i> Вконтакте
      </span>
      <div class="profile__item-value">
        <div class="profile__form">
          <span class="profile__item-link">
            <?php 
              if($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
            ?>
            <input class="profile__field" type="text" name="vk" value="<?=$user->getVk()?>">
          </span>
          <span class="profile__edit"><i class="fas fa-pencil-alt"></i></span>
          <?php
            else:
          ?>
            <p class="profile__field"><?=$user->getVk()?></p>
          </span>
          <?php endif ?>
        </div>
      </div>
    </li>
    <li class="profile__item">
      <span class="profile__item-name">
        <i class="fab fa-odnoklassniki"></i> Одноклассники
      </span>
      <div class="profile__item-value">
        <div class="profile__form">
          <span class="profile__item-link">
            <?php 
              if($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
            ?>
            <input class="profile__field" type="text" name="ok" value="<?=$user->getOk()?>">
          </span>
          <span class="profile__edit"><i class="fas fa-pencil-alt"></i></span>
          <?php
            else:
          ?>
            <p class="profile__field"><?=$user->getOk()?></p>
          </span>
          <?php endif ?>
        </div>
      </div>
    </li>
    <li class="profile__item">
      <span class="profile__item-name">
        <i class="fab fa-instagram"></i> Инстаграм
      </span>
      <div class="profile__item-value">
        <div class="profile__form">
          <span class="profile__item-link">
            <?php 
              if($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
            ?>
            <input class="profile__field" type="text" name="instagram" value="<?=$user->getInstagram()?>">
          </span>
          <span class="profile__edit"><i class="fas fa-pencil-alt"></i></span>
          <?php
            else:
          ?>
            <p class="profile__field"><?=$user->getInstagram()?></p>
          </span>
          <?php endif ?>
        </div>
      </div>
    </li>
    <li class="profile__item">
      <span class="profile__item-name">
        <i class="fab fa-youtube"></i> Ютуб
      </span>
      <div class="profile__item-value">
        <div class="profile__form">
          <span class="profile__item-link">
          <?php 
              if($isAuth == 1 && strtolower($alias) === strtolower($_SESSION['user']['login'])):
            ?>
            <input class="profile__field" type="text" name="youtube" value="<?=$user->getYoutube()?>">
          </span>
          <span class="profile__edit"><i class="fas fa-pencil-alt"></i></span>
          <?php
            else:
          ?>
            <p class="profile__field"><?=$user->getYoutube()?></p>
          </span>
          <?php endif ?>
        </div>
      </div>
    </li>
  </ul>
</section>