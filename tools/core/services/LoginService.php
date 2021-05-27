<?php

namespace tools\core\services;

use app\models\User;

trait LoginService
{

    /**
     * method for sending the newly generated user password.
     * @param User $user user object
     * @param string $email current email
     */
    public function sendLetter(User $user,string $email)
    {
        $newPassword = generatePassword();
        $to      = "'" . $email . "'";
        $subject = 'Смена пароля';
        $message = 'Здравствуйте! Ваш новый пароль - ' . $newPassword;
        $headers = array (
            'From' => 'admin@apblog.ua',
            'Reply-To' => 'admin@apblog.ua',
            'X-Mailer' => 'PHP/'. phpversion()
        );
        mail($to, $subject, $message, $headers);
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $user->updatePassword($newPassword, $_POST['forgot']);
    }
}