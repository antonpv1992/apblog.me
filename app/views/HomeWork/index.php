<nav class='navigation'>
  <ul class='navigation__list'>
    <li class='navigation__item'>
      <a class='navigation__link' href='#lesson_1'>Урок 1 <i class="fas fa-long-arrow-alt-down"></i></a>
    </li>
    <li class='navigation__item'>
      <a class='navigation__link' href='#lesson_2'>Урок 2 <i class="fas fa-long-arrow-alt-down"></i></a>
    </li>
    <li class='navigation__item'>
      <a class='navigation__link' href='#lesson_3'>Урок 3 <i class="fas fa-long-arrow-alt-down"></i></a>
    </li>
  </ul>
</nav>
<main class='content'>
  <section class='content__multi-tables'>
  <h3 class='content__sub-title'>Таблица умножения</h3>
    <table id="lesson_1" class='content__table'>
      <?php
        outputTable();
      ?>
    </table>
  </section>
  <section class='content__multi-tables'>
    <h3 class='content__sub-title'>
      <?php paintWord('Цветная') ?> таблица умножения
    </h3>
    <table id="lesson_2" class='content__table'>
      <?php
        outputTable(true);
      ?>
    </table>
  </section>
  <section class='content__form-container'>
    <h3 class='content__sub-title'>Форма</h3>
    <form id="lesson_3" class='content__form form' action="home-work/action" method="post">
      <div class='form__field-wrapper'>
        <textarea class='form__field' name="string" placeholder="Введите текст"></textarea>
        <span class='form__shadow'></span>
      </div>
      <div class='form__field-wrapper'>
        <button class='form__button' type="submit">
          <span class='form__button-value'>Отправить
            <i class="fa fa-long-arrow-right"></i>
          </span>
          <span class='button-shadow'></span>
        </button>
      </div>
    </form>
  </section>
</main>
<footer class='footer'>
  <h6 class='footer__copy'><i class="fas fa-copyright"></i> Created by <a href="https://github.com/antonpv1992">Antonpv1992<a></h6>
</footer>
