<?php 

namespace tools\core\services;

use app\models\Contact;
use app\models\User;
use tools\core\Db;
use tools\core\mappers\ContactMapper;
use tools\core\mappers\UserMapper;

trait RegistrationService 
{
    
    /**
     * method for outputting existing users by ajax
     */
    protected function dataExists(): void
    {
        $umapper = new UserMapper(DB::instance());
        $users = $umapper->getUsers("login, email");
        $array = [];
        foreach($users as $user){
            array_push($array, $user->getAllFields());
        }
        $array = json_encode($array, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
        echo $array;
        exit();
    }

    /**
     * method for user registration
     * @param array $data registration data array
     */
    protected function registrationUser(array $data): void
    {
        $umapper = new UserMapper(DB::instance());
        $cmapper = new ContactMapper(DB::instance());
        $user = new User($data, false);
        $umapper->save($user->getAllFields());
        $seance = $umapper->getUser("id, login, email, password", "login='" . $user->getLogin() . "'");
        $contact = new Contact(['user' => $seance->getID()]);
        $cmapper->save($contact->getAllFields());
        $_SESSION['user'] = $seance->getAllFields();
        setcookie("user", json_encode($seance->getAllFields(), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK), time() + (86400 * 7));
    }
}