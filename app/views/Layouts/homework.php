<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=1, initial-scale=1.0">
  <title><?=$title?></title>
  <link rel="stylesheet" href="/assets/styles/bundle.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
  <header class='header'>
    <ul class="header__menu">
      <li class="header__menu-item">
        <a class="header__menu-title" href="/">APBlog</a>
      </li>
      <ul class="header__menu-list">
        <li class="header__menu-item">
          <a class="fas fa-user-tie" href="/profile"><?=isset($_SESSION['user']) ? $_SESSION['user']['login'] : ''?></a>
        </li>
          <?php
          if (!isset($_SESSION['user'])):
              ?>
            <li class="header__menu-item">
              <a class="fas fa-user-plus" href="/sign-in">Войти</a>
            </li>
          <?php else: ?>
            <li class="header__menu-item">
              <a class="fas fa-user-minus" href="/logout">Выйти</a>
            </li>
          <?php endif ?>
      </ul>
    </ul>
  </header>
  <?=$content?>
  <div class='scroll-top'>
    <i class="fa fa-long-arrow-up"></i>
    <span class='button-shadow'></span>
  </div>
  <script defer src="/assets/scripts/bundle.min.js"></script>
</body>
</html>