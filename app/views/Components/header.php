<header class="header">
  <h1 class="header__title">
    <a class="header__title-link" href="/">APBlog</a>
  </h1>
  <?php include_once '../app/views/Components/navigation.php' ?>
  <nav class="header__menu">
    <ul class="header__menu-list">
      <li class="header__menu-search">
        <a class="fas fa-search-plus">Поиск</a>
        <form class="header__menu-form" method="post" action="/posts/search">
          <input class="header__menu-input" type="text" name="query" placeholder="Поиск" />
        </form>
      </li>
      <?php if(isset($_SESSION['user'])):?>
      <li class="header__menu-item">
        <a class="fas fa-user-tie" href="/profile"><?=isset($_SESSION['user']) ? $_SESSION['user']['login'] : ''?></a>
      </li>
      <?php
        endif;
        if(!isset($_SESSION['user'])):
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
  </nav>
</header>