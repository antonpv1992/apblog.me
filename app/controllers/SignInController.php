<?php

namespace app\controllers;

use tools\core\FormValidation;
use app\models\User;
use tools\core\services\LoginService;

class SignInController extends AppController
{

    use LoginService;

    /**
     * main page sign-in
     */
    public function indexAction(): void
    {
        if (isset($_SESSION['user'])) {
            redirect('/');
        }
        $title = 'SignIn';
        $error = '';
        if (!empty($_POST)) {
            if (
                isset($_POST['login'])
                && isset($_POST['password'])
            ) {
                $error = FormValidation::entry(['login' => hsc($_POST['login']), 'password' => hsc($_POST['password'])]);
                if ($error === '') {
                    $uModel = new User([]);
                    $user = $uModel->getSingleUser($_POST['login']);
                    $_SESSION['user'] = $user->getAllFields();
                    if (isset($_POST['remember'])) {
                        setcookie("user", json_encode($user->getAllFields(), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK), time() + (86400 * 7));
                    }
                    redirect('/');
                }
            } else {
                $error = "<p class='form-input__error'>Заполните все поля</p>";
            }
        }
        $this->set(compact('title', 'error'));
    }

    /**
     *remember page
     */
    public function rememberAction(): void
    {
        if (isset($_SESSION['user'])) {
            redirect('/');
        }
        $title = 'Remember';
        $error = '';
        $user = new User([]);
        if (isset($_POST['forgot'])) {
            if ($user->isEmail(hsc($_POST['forgot']))) {
                $this->sendLetter($user, $_POST['forgot']);
            } else {
                $error = "<p class='form-input__error'>Пользователя с таким email не существует!</p>";
            }
        }
        $this->set(compact('title', 'error'));
    }
}