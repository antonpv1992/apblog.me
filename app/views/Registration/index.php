<form name="auth" class="form-auth" method="post">
  <h2 class="form-auth__title">Форма Регистрации</h2>
  <div class="form-auth__field-input">
    <input id="login" name="login" class="form-auth__input" type="text" value="<?php echo isset($_POST['login']) ? $_POST['login'] : NULL?>" required>
    <label for="login" class="form-auth__label">Логин</label>
    <span class="form-auth__focus"></span> 
    <?php isset($errors['login']) ? \tools\core\FormValidation::printErrors($errors['login']) : ''?>
  </div>
  <div class="form-auth__field-input">
    <input id="email" name="email" class="form-auth__input" type="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : NULL?>" required>
    <label for="email" class="form-auth__label">Почта</label>
    <span class="form-auth__focus"></span> 
    <?php isset($errors['email']) ? \tools\core\FormValidation::printErrors($errors['email']) : ''?>
  </div>
  <div class="form-auth__field-input">
    <i class="fa fa-eye"></i>
    <input id="password" name="password" class="form-auth__input" type="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : NULL?>" required>
    <label for="password" class="form-auth__label">Пароль</label>
    <span class="form-auth__focus"></span> 
    <?php isset($errors['password']) ? \tools\core\FormValidation::printErrors($errors['password']) : ''?>
  </div>
  <div class="form-auth__field-input">
    <i class="fa fa-eye"></i>
    <input id="password-repeat" name="password-repeat" class="form-auth__input" type="password" value="<?php echo isset($_POST['password-repeat']) ? $_POST['password-repeat'] : NULL?>" required>
    <label for="password-repeat" class="form-auth__label">Повторите пароль</label>
    <span class="form-auth__focus"></span> 
    <?php isset($errors['password-repeat']) ? \tools\core\FormValidation::printErrors($errors['password-repeat']) : ''?>
  </div>
  <div class="form-auth__field-input">
    <input id="name" name="name" class="form-auth__input" type="text" value="<?php echo isset($_POST['name']) ? $_POST['name'] : NULL?>">
    <label for="name" class="form-auth__label">Имя</label>
    <span class="form-auth__focus"></span>
    <?php isset($errors['name']) ? \tools\core\FormValidation::printErrors($errors['name']) : ''?>
  </div>
  <div class="form-auth__field-input">
    <input id="surname" name="surname" class="form-auth__input" type="text" value="<?php echo isset($_POST['surname']) ? $_POST['surname'] : NULL?>">
    <label for="surname" class="form-auth__label">Фамилия</label>
    <span class="form-auth__focus"></span> 
    <?php isset($errors['surname']) ? \tools\core\FormValidation::printErrors($errors['surname']) : ''?>
  </div>
  <div class="form-auth__field-input">
    <input id="birthday" name="birthday" class="form-auth__input" type="date" value="<?php echo isset($_POST['birthday']) ? $_POST['birthday'] : NULL?>">
    <label for="birthday" class="form-auth__label">Дата Рождения</label>
    <span class="form-auth__focus"></span>
    <?php isset($errors['birthday']) ? \tools\core\FormValidation::printErrors($errors['birthday']) : ''?>
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
    <input id="country" name="country" class="form-auth__input" type="text" value="<?php echo isset($_POST['country']) ? $_POST['country'] : NULL?>">
    <label for="country" class="form-auth__label">Страна</label>
    <span class="form-auth__focus"></span> 
    <?php isset($errors['country']) ? \tools\core\FormValidation::printErrors($errors['country']) : ''?>
  </div>
  <div class="form-auth__field-input">
    <input id="city" name="city" class="form-auth__input" type="text" value="<?php echo isset($_POST['city']) ? $_POST['city'] : NULL?>">
    <label for="city" class="form-auth__label">Город</label>
    <span class="form-auth__focus"></span> 
    <?php isset($errors['city']) ? \tools\core\FormValidation::printErrors($errors['city']) : ''?>
  </div>
  <div class="form-auth__field-input">
    <input id="phone" name="phone" class="form-auth__input" type="tel" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : NULL?>">
    <label for="phone" class="form-auth__label">Телефон</label>
    <span class="form-auth__focus"></span> 
    <?php isset($errors['phone']) ? \tools\core\FormValidation::printErrors($errors['phone']) : ''?>
  </div>
  <div class="form-auth__field">
    <div class="form-auth__buttons">
      <button class="form-auth__signup" type="submit">
        Зарегистрироваться
      </button>
    </div>
  </div>
</form>