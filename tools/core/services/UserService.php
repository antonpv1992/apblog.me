<?php

namespace tools\core\services;

use app\models\user;
use app\models\contact;

trait UserService
{

     /**
     * method for changing profile data in db
     */
    protected function changeUserData(): void
    {
        $user = new User([]);
        if (isset($_FILES['avatar'])) {
            $user->updateAvatar($_FILES['avatar']['tmp_name'], $_SESSION['user']['id']);
            echo file_get_contents($_FILES['avatar']['tmp_name']);
            exit();
        }
        $ukey = '';
        $uvalue = '';
        foreach ($_POST as $key => $value) {
            $ukey = $key;
            $uvalue = hsc($value);
        }
        $contactObj = new Contact([]);
        if ($user->isCol($ukey)) {
            $user->updateCurrentField($ukey, $uvalue, $_SESSION['user']['id']);
        } elseif ($contactObj->isCol($ukey)) {
            $contactObj->updateCurrentField($ukey, $uvalue, $_SESSION['user']['id']);
        }
        exit();
    }

    /**
     * method that gets the user by login
     * @param string $login login
     * @return User current user
     */
    protected function getUserByLogin(string $login): User
    {
        $user = new User([]);
        return $user->getByLogin($login);
    }

    /**
     * method to check if the user exists
     * @param string $login login
     * @return bool true if user exists
     */
    protected function isUserByLogin(string $login): bool
    {
        $user = new User([]);
        return $user->aliasExists($login);
    }
}