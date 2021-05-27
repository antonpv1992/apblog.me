<?php

namespace tools\core\services;

use app\models\Contact;
use app\models\User;

trait RegistrationService
{

    /**
     * method for outputting existing users by ajax
     */
    public function dataExists(): void
    {
        $uModel = new User([]);
        $users = $uModel->getLoginAndEmail();
        $array = [];
        foreach ($users as $user) {
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
    public function registrationUser(array $data): void
    {
        $user = new User($data, false);
        $user = $user->saveUser();
        $contact = new Contact(['user' => $user->getID()]);
        $contact->saveContact();
        $_SESSION['user'] = $user->getAllFields();
        setcookie("user", json_encode($user->getAllFields(), JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK), time() + (86400 * 7));
    }
}