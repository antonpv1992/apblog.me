<?php

namespace tools\core;

use tools\core\mappers\UserMapper;

class FormValidation
{

    /**
     * main method for validating registration form fields
     * @param array $fields form fields
     * @return array array of errors
     */
    public static function validate(array $fields): array
    {
        $instance = new FormValidation();
        $errors = [];
        foreach ($fields as $key => $value) {
            $keyErrors = [];
            switch ($key) {
                case 'login':
                    ($instance->checkLogin($value) !== '') ? array_push($keyErrors, $instance->checkLogin($value)) : '';
                    ($instance->checkEmpty($value) !== '') ? array_push($keyErrors, $instance->checkEmpty($value)) : '';
                    ($instance->checkLoginExists($value) !== '') ? array_push(
                        $keyErrors,
                        $instance->checklLoginExists($value)
                    ) : '';
                    break;
                case 'email':
                    ($instance->checkEmail($value) !== '') ? array_push($keyErrors, $instance->checkEmail($value)) : '';
                    ($instance->checkEmpty($value) !== '') ? array_push($keyErrors, $instance->checkEmpty($value)) : '';
                    ($instance->checkEmailExists($value) !== '') ? array_push(
                        $keyErrors,
                        $instance->checklEmailExists($value)
                    ) : '';
                    break;
                case 'password':
                    ($instance->checkPassword($value) !== '') ? array_push(
                        $keyErrors,
                        $instance->checkPassword($value)
                    ) : '';
                    ($instance->checkEmpty($value) !== '') ? array_push($keyErrors, $instance->checkEmpty($value)) : '';
                    break;
                case 'password-repeat':
                    ($instance->checkRepeatPassword($fields['password'], $value) !== '') ? array_push(
                        $keyErrors,
                        $instance->checkRepeatPassword(
                            $fields['password'],
                            $value
                        )
                    ) : '';
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
     * the main method for validating user login to the site
     * @param array $fields form fields
     * @return string error or empty string
     */
    public static function entry(array $fields): string
    {
        $instance = new FormValidation();
        $mapper = new UserMapper(Db::instance());
        $user = $mapper->getOne($fields['login'], 'login');
        if (
            strtolower($fields['login']) === strtolower($user->getLogin())
            && (password_verify($fields['password'], $user->getPassword()))
        ) {
            return '';
        } else {
            return $instance->createError('???????????????? ?????????? ?????? ????????????');
        }
    }

    /**
     * method for user verification
     * @param array $cookies data stored in cookies
     * @return bool verification result
     */
    public static function verify(array $cookies): bool
    {
        $umapper = new UserMapper(Db::instance());
        $user = $umapper->getUser("id, login, email, password", "login='" . $cookies['login'] . "'");
        foreach ($user->getAllFields() as $key => $value) {
            if ($cookies[$key] != $value) {
                return false;
            }
        }
        return true;
    }

    /**
     * method for displaying errors to the user
     * @param array $errors array of errors
     */
    public static function printErrors(array $errors): void
    {
        foreach ($errors as $error) {
            echo $error;
        }
    }

    /**
     * method that checks for an empty field
     * @param string $field
     * @return string error or empty string
     */
    private function checkEmpty(string $field): string
    {
        if ($field === '') {
            return $this->createError('???????????? ???????? ???????????? ???? ???????????? ???????? ????????????!');
        }
        return '';
    }

    /**
     * method for checking login
     * @param string $login
     * @return string error or empty string
     */
    private function checkLogin(string $login): string
    {
        if (preg_match('/^[a-zA-z??-????-??_]{1}[a-zA-Z1-9??-????-??_-]{3,24}$/', $login) !== 1) {
            return $this->createError(
                '?????????? ???????????? ???????????????????? ?? ?????????? ?????? ?????????? ?????????????????????????? ?? ???????? ?????????????? 3 ?? ???????????? 26 ????????????????'
            );
        }
        return '';
    }

    /**
     * method for checking password
     * @param string $password
     * @return string error or empty string
     */
    private function checkPassword(string $password): string
    {
        if (preg_match_all('/(?=.*[0-9])(?=.*[a-z])[0-9!@#$%^&*a-zA-Z]{6,}/', $password) !== 1) {
            return $this->createError(
                '???????????? ???????????? ?????????????????? ?????????????? ???????? ?????????? ?? ??????????, ?? ?????? ???? ???????? ???? ???????????? 6 ????????????????'
            );
        }
        return '';
    }

    /**
     * method for checking the correctness of the entered password in the second field
     * @param string $password
     * @param string $repeat
     * @return string error or empty string
     */
    private function checkRepeatPassword(string $password, string $repeat): string
    {
        if ($password !== '' && $password !== $repeat) {
            return $this->createError('???????????? ???? ??????????????????');
        }
        return '';
    }

    /**
     * method for checking email
     * @param string $email
     * @return string error or empty string
     */
    private function checkEmail(string $email): string
    {
        if (preg_match(
                '/(?:[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/',
                $email
            ) !== 1) {
            return $this->createError('???????????????? ???????????? ??????????!');
        }
        return '';
    }

    /**
     * method for checking phone
     * @param string $phone
     * @return string error or empty string
     */
    private function checkPhone(string $phone): string
    {
        if (preg_match('/((\+)?\b(8|38)?(0[\d]{2}))([\d-]{5,8})([\d]{2})/', $phone) !== 1 && $phone !== '') {
            return $this->createError('???????????????? ???????????? ?????????????????????? ????????????!');
        }
        return '';
    }

    /**
     * method for checking text
     * @param string $input
     * @return string error or empty string
     */
    private function checkText(string $input): string
    {
        if (preg_match('/^[,.\'-??-??a-z]{2,}$/i', $input) !== 1 && $input !== '') {
            return $this->createError('???????????? ???????? ???????????? ???????? ???? ???????????? 2-?? ???????????????? ?? ???????????????? ???? ????????!');
        }
        return '';
    }

    /**
     * method for generating html error
     * @param string $text
     * @return string error
     */
    private function createError(string $text): string
    {
        return "<p class='form-input__error'>$text</p>";
    }

    /**
     * method to check if login exists
     * @param string $login
     * @return string error or empty string
     */
    private function checkLoginExists(string $login): string
    {
        $mapper = new UserMapper(DB::instance());
        if ($mapper->isUserExists($login)) {
            return $this->createError('???????????????????????? ?? ?????????? ?????????????? ?????? ????????????????????!');
        }
        return '';
    }

    /**
     * method to check if email exists
     * @param string $email
     * @return string error or empty string
     */
    private function checkEmailExists(string $email): string
    {
        $mapper = new UserMapper(DB::instance());
        if ($mapper->isEmailExists($email)) {
            return $this->createError('???????????????????????? ?? ?????????? ???????????? ?????? ????????????????????!');
        }
        return '';
    }
}