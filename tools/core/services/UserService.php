<?php 

namespace tools\core\services;

use tools\core\mappers\ContactMapper;
use tools\core\mappers\UserMapper;

trait UserService 
{
     /**
     * method for changing profile data in db
     * @param UserMapper $users user model mapper
     * @param ContactMapper $contacts contact model mapper
     */
    protected function changeUserData(UserMapper $users, ContactMapper $contacts): void
    {
        if(isset($_FILES['avatar'])){
            $blob = addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
            echo file_get_contents($_FILES['avatar']['tmp_name']);
            $users->updateUserField("avatar='$blob'", "id=" . $_SESSION['user']['id']);
            exit();
        }
        $ukey = '';
        $uvalue = '';
        foreach($_POST as $key => $value){
            $ukey = $key;
            $uvalue = hsc($value);
        }
        if($users->isCol($ukey) === '1'){
            $users->updateUserField("$ukey='$uvalue'", "id=" . $_SESSION['user']['id']);
        } else if($contacts->isCol($ukey) === '1'){
            $contacts->updateContactField("$ukey='$uvalue'", "user=" . $_SESSION['user']['id']);
        }
        exit();
    }
}