<?php


namespace app\controllers;


class SignInController extends AppController
{
    /**
     *
     */
    public function indexAction()
    {
        if(isset($_SESSION['user'])){
            redirect('/');
        }
        $title = 'SignIn';
        $error = '';
        if(!empty($_POST)){
            if(isset($_POST['login']) && isset($_POST['password'])){
                $error = \tools\core\FormValidation::entry(['login' => hsc($_POST['login']), 'password' => hsc($_POST['password'])]);//['login' => 'Qwerty', 'password' => 'qwe123']
                if($error === ''){
                    $umapper = new \tools\core\mappers\UserMapper(\tools\core\Db::instance());
                    $user = $umapper->getUser("id, login, email, password", "login='" . $_POST['login'] . "'");
                    $_SESSION['user'] = $user->getAllFields();
                    if(isset($_POST['remember'])) {
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
     *
     */
    public function rememberAction()
    {
        if(isset($_SESSION['user'])){
            redirect('/');
        }
        $title = 'Remember';
        $error = '';
        $user = new \tools\core\mappers\UserMapper(\tools\core\Db::instance());
        if(isset($_POST['forgot'])){
            if($user->isEmailExists(hsc($_POST['forgot']))){
                $newPassword = generatePassword();
                $to      = "'" . $_POST['forgot'] . "'";
                $subject = 'Смена пароля';
                $message = 'Здравствуйте! Ваш новый пароль - ' . $newPassword;
                $headers = array(
                    'From' => 'admin@apblog.ua',
                    'Reply-To' => 'admin@apblog.ua',
                    'X-Mailer' => 'PHP/'. phpversion()
                );
                mail($to, $subject, $message, $headers);
                $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $user->updateUserField("password='$newPassword'", "email='" . $_POST['forgot'] ."'");
            } else {
                $error = "<p class='form-input__error'>Пользователя с таким email не существует!</p>";
            }
        }
        $this->set(compact('title', 'error'));
    }
}