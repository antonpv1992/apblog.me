<?php

namespace tools\core\services;

use app\models\User;

trait LoginService
{

    /**
     * method for sending the newly generated user password.
     * @param string $email current email
     */
    public function sendLetter(string $email)
    {
        $user = new User([]);
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

    /**
     * method for getting user by login
     * @param string $login login
     * @return User current user
     */
    public function getUserByLogin(string $login): User
    {
        $user = new User([]);
        return $user->getSingleUser($login);
    }

    /**
     * method to check if mail exists
     * @param string $email mail
     * @return bool
     */
    public function isEmailExists(string $email): bool
    {
        $user = new User([]);
        return $user->isEmail($email);
    }
}