<?php


namespace tools\core;


class FormValidation
{

    /**
     * @param $fields
     * @return array
     */
    public static function validate($fields)
    {
        $instance = new FormValidation();
        $errors = [];
        foreach($fields as $key => $value){
            $keyErrors = [];
            switch($key){
                case 'login':
                    ($instance->checkLogin($value) !== '') ? array_push($keyErrors, $instance->checkLogin($value)) : '';
                    ($instance->checkEmpty($value) !== '') ? array_push($keyErrors, $instance->checkEmpty($value)) : '';
                    ($instance->checklLoginExists($value) !== '') ? array_push($keyErrors, $instance->checklLoginExists($value)) : '';
                    break;
                case 'email':
                    ($instance->checkEmail($value) !== '') ? array_push($keyErrors, $instance->checkEmail($value)) : '';
                    ($instance->checkEmpty($value) !== '') ? array_push($keyErrors, $instance->checkEmpty($value)) : '';
                    ($instance->checklEmailExists($value) !== '') ? array_push($keyErrors, $instance->checklEmailExists($value)) : '';
                    break;
                case 'password':
                    ($instance->checkPassword($value) !== '') ? array_push($keyErrors, $instance->checkPassword($value)) : '';
                    ($instance->checkEmpty($value) !== '') ? array_push($keyErrors, $instance->checkEmpty($value)) : '';
                    break;
                case 'password-repeat':
                    ($instance->checkRepeatPassword($fields['password'], $value) !== '') ? array_push($keyErrors, $instance->checkRepeatPassword($fields['password'], $value)) : '';
                    break;
                case 'phone':
                    ($instance->checkPhone($value) !== '') ? array_push($keyErrors, $instance->checkPhone($value)) : '';
                    break;
                case 'name':
                case 'surname':
                case 'city':
                case 'country':
                    ($instance->checkText($value) !== '') ? array_push($keyErrors, $instance->checkText($value)) : '';
                    break;
                default:
                    break;
            }
            (count($keyErrors) !== 0) ? $errors[$key] = $keyErrors : '';
        }
        return $errors;
    }

    /**
     * @param $fields
     * @return string
     */
    public static function entry($fields)
    {
        $instance = new FormValidation();
        $mapper = new \tools\core\mappers\UserMapper(\tools\core\Db::instance());
        $user = $mapper->getOne($fields['login'], 'login');
        if(strtolower($fields['login']) === strtolower($user->getLogin()) && (password_verify($fields['password'], $user->getPassword()))){
            return '';
        } else {
            return $instance->createError('Неверный логин или пароль');
        }
    }

    /**
     * @param $cookies
     * @return bool
     */
    public static function verify($cookies)
    {
        $umapper = new \tools\core\mappers\UserMapper(\tools\core\Db::instance());
        $user = $umapper->getUser("id, login, email, password", "login='" . $cookies['login'] . "'");
        foreach ($user->getAllFields() as $key => $value) {
            if($key == 'password' && $cookies['password'] !== $value){
                return false;
            } else if($cookies[$key] != $value) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param $errors
     */
    public static function printErrors($errors)
    {
        foreach($errors as $error){
            echo $error;
        }
    }

    /**
     * @param $field
     * @return string
     */
    private function checkEmpty($field)
    {
        if($field === ''){
            return $this->createError('Данное поле должно не должно быть пустым!');
        }
        return '';
    }

    /**
     * @param $login
     * @return string
     */
    private function checkLogin($login)
    {
        if(preg_match('/^[a-zA-zа-яА-Я_]{1}[a-zA-Z1-9а-яА-Я_-]{3,24}$/', $login) !== 1) {
            return $this->createError('Логин должен начинаться с буквы или знака подчеркивания и быть длиннее 3 и короче 26 символов');
        }
        return '';
    }

    /**
     * @param $password
     * @return string
     */
    private function checkPassword($password)
    {
        if(preg_match_all('/(?=.*[0-9])(?=.*[a-z])[0-9!@#$%^&*a-zA-Z]{6,}/', $password) !== 1) {
            return $this->createError('Пароль должен содержать минимум одну букву и цифру, а так же быть не короче 6 символов');
        }
        return '';
    }

    /**
     * @param $password
     * @param $repeat
     * @return string
     */
    private function checkRepeatPassword($password, $repeat)
    {
        if($password !== '' && $password !== $repeat) {
            return $this->createError('Пароли не совпадают');
        }
        return '';
    }

    /**
     * @param $email
     * @return string
     */
    private function checkEmail($email)
    {
        if(preg_match('/(?:[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/', $email) !== 1){
            return $this->createError('Неверный формат почты!');
        }
        return '';
    }

    /**
     * @param $phone
     * @return string
     */
    private function checkPhone($phone)
    {
        if(preg_match('/((\+)?\b(8|38)?(0[\d]{2}))([\d-]{5,8})([\d]{2})/', $phone) !== 1 && $phone !== ''){
            return $this->createError('Неверный формат телефонного номера!');
        }
        return '';
    }

    /**
     * @param $input
     * @return string
     */
    private function checkText($input)
    {
        if(preg_match('/^[,.\'-а-яa-z]{2,}$/i', $input) !== 1 && $input !== ''){
            return $this->createError('Данное поле должно быть не короче 2-х символов и состоять из букв!');
        }
        return '';
    }

    /**
     * @param $text
     * @return string
     */
    private function createError($text)
    {
        $p = "<p class='form-input__error'>$text</p>";
        return $p;
    }

    /**
     * @param $login
     * @return string
     */
    private function checklLoginExists($login)
    {
        $mapper = new \tools\core\mappers\UserMapper(DB::instance());
        if($mapper->isUserExists($login)){
            return $this->createError('Пользователь с таким логином уже существует!');
        }
        return '';
    }

    /**
     * @param $email
     * @return string
     */
    private function checklEmailExists($email)
    {
        $mapper = new \tools\core\mappers\UserMapper(DB::instance());
        if($mapper->isEmailExists($email)){
            return $this->createError('Пользователь с такой почтой уже существует!');
        }
        return '';
    }
}