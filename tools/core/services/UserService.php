<?php

namespace tools\core\services;

use app\models\user;
use app\models\contact;

trait UserService
{
     /**
     * method for changing profile data in db
     * @param User $user user model object
     */
    protected function changeUserData(User $user): void
    {
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
}