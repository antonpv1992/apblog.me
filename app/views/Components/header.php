<header class="header">
  <h1 class="header__title">
    <a class="header__title-link" href="#">APBlog</a>
  </h1>
  <?php include_once '../app/views/components/navigation.php' ?>
  <nav class="header__menu">
    <ul class="header__menu-list">
      <li class="header__menu-search">
        <a class="fas fa-search-plus" href="#">Поиск</a>
        <form class="header__menu-form" method="get" action="#">
          <input class="header__menu-input" type="text" name="query" placeholder="Поиск" />
        </form>
      </li>
      <li class="header__menu-item">
        <a class="fas fa-user-tie" href="#">Профиль</a>
      </li>
      <li class="header__menu-item">
        <a class="fas fa-user-plus" href="#">Войти</a>
      </li>
    </ul>
  </nav>
</header>