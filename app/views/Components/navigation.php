<nav class="header__links navigation">
  <ul class="navigation__list">
    <li class="navigation__item">
      <a class="navigation__link" href="/posts/php">PHP</a>
    </li>
    <li class="navigation__item">
      <a class="navigation__link" href="/posts/js">JavaScript</a>
    </li>
    <li class="navigation__item">
      <a class="navigation__link" href="/posts/html">HTML</a>
    </li>
    <li class="navigation__item">
      <a class="navigation__link" href="/posts/css">CSS</a>
    </li>
    <?php if(isset($_SESSION['user'])): ?>
    <li class="navigation__item">
      <a class="navigation__link" href="/home-work">HM</a>
    </li>
    <?php endif?>
  </ul>
</nav>