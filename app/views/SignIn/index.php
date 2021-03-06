<form class="form-auth" method="post">
  <h2 class="form-auth__title">Форма входа</h2>
  <div class="form-auth__field-input">
    <input id="login" name="login" class="form-auth__input" type="text" value="<?=isset($_POST['login']) ? $_POST['login'] : NULL?>"  required>
    <label for="login" class="form-auth__label">Логин</label>
    <span class="form-auth__focus"></span>
  </div>
  <div class="form-auth__field-input">
    <i class="fa fa-eye"></i>
    <input id="password" name="password" class="form-auth__input" type="password" value="<?=isset($_POST['password']) ? $_POST['password']: NULL?>" required>
    <label for="password" class="form-auth__label">Пароль</label>
    <span class="form-auth__focus"></span>
    <?=$error?>
  </div>
  <div class="form-auth__field">
    <div class="form-auth__checkbox">
      <input id="remember" name="remember" class="form-auth__check" type="checkbox">
      <label for="remember" class="form-auth__checkbox-label">
        <i class="far fa-square"></i>
        <span class="form-auth__checkbox-label-title">Запомни меня</span>
      </label>
      <a class="form-auth__checkbox-forgot" href="/sign-in/remember">Забыли пароль?</a>
    </div>
  </div>
  <div class="form-auth__field">
    <div class="form-auth__buttons">
      <button class="form-auth__signin" type="submit">
        Войти
      </button>
      <a href="/registration"><button class="form-auth__signup" type="button">
        <span class="form-auth__signup-desc">Нет учетной записи?</span>
        Зарегистрироваться
      </button></a>
    </div>
  </div>   
</form>