<form class="form-auth">
  <h2 class="form-auth__title">Форма Регистрации</h2>
  <div class="form-auth__field-input">
    <input id="login" name="login" class="form-auth__input" type="text">
    <label for="login" class="form-auth__label">Логин</label>
    <span class="form-auth__focus"></span>
  </div>
  <div class="form-auth__field-input">
    <input id="email" name="email" class="form-auth__input" type="email">
    <label for="email" class="form-auth__label">Почта</label>
    <span class="form-auth__focus"></span>
  </div>
  <div class="form-auth__field-input">
    <i class="fa fa-eye"></i>
    <input id="password" name="password" class="form-auth__input" type="password">
    <label for="password" class="form-auth__label">Пароль</label>
    <span class="form-auth__focus"></span>
  </div>
  <div class="form-auth__field-input">
    <i class="fa fa-eye"></i>
    <input id="password-repeat" name="password-repeat" class="form-auth__input" type="password">
    <label for="password-repeat" class="form-auth__label">Повторите пароль</label>
    <span class="form-auth__focus"></span>
  </div>
  <div class="form-auth__field-input">
    <input id="name" name="name" class="form-auth__input" type="text">
    <label for="name" class="form-auth__label">Имя</label>
    <span class="form-auth__focus"></span>
  </div>
  <div class="form-auth__field-input">
    <input id="last-name" name="last-name" class="form-auth__input" type="text">
    <label for="last-name" class="form-auth__label">Фамилия</label>
    <span class="form-auth__focus"></span>
  </div>
  <div class="form-auth__field-input">
    <input id="birthday" name="birthday" class="form-auth__input" type="date">
    <label for="birthday" class="form-auth__label">Возраст</label>
    <span class="form-auth__focus"></span>
  </div>
  <div class="form-auth__field">
    <span style="font-size: 14px;">Пол</span>
    <fieldset class="form-auth__checkbox">
      <input id="man" name="man" class="form-auth__check" type="checkbox">
      <label for="man" class="form-auth__checkbox-label">
        <i class="far fa-square"></i>
        <span class="form-auth__checkbox-label-title">Мужской</span>
      </label>
      <input id="woman" name="woman" class="form-auth__check" type="checkbox">
      <label for="woman" class="form-auth__checkbox-label">
        <i class="far fa-square"></i>
        <span class="form-auth__checkbox-label-title">Женский</span>
      </label>
    </fieldset>
  </div>
  <div class="form-auth__field-input">
    <input id="country" name="country" class="form-auth__input" type="text">
    <label for="country" class="form-auth__label">Страна</label>
    <span class="form-auth__focus"></span>
  </div>
  <div class="form-auth__field-input">
    <input id="city" name="city" class="form-auth__input" type="text">
    <label for="city" class="form-auth__label">Город</label>
    <span class="form-auth__focus"></span>
  </div>
  <div class="form-auth__field-input">
    <input id="phone" name="phone" class="form-auth__input" type="tel">
    <label for="phone" class="form-auth__label">Телефон</label>
    <span class="form-auth__focus"></span>
  </div>
  <div class="form-auth__field">
    <div class="form-auth__buttons">
      <button class="form-auth__signup" type="submit">
        Зарегистрироваться
      </button>
    </div>
  </div>
</form>