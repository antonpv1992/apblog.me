<?php

namespace app\controllers;

use tools\core\FormValidation;
use tools\core\services\RegistrationService;

class RegistrationController extends AppController
{

    use RegistrationService;

    /**
     *main page Registration
     */
    public function indexAction(): void
    {
        if(isset($_SESSION['user'])){
            redirect('/');
        }
        if(isset($_POST['data'])){
            $this->dataExists();
        }
        $title = 'Registration';
        $this->set(compact('title'));
        if(!empty($_POST)){
            $postData = [];
            foreach($_POST as $key => $value) {
                $postData[$key] = hsc($value);
            }
            $errors = FormValidation::validate($postData);
            if(empty($errors)){
                $this->registrationUser($postData);
                redirect('/');
            }
            $this->set(compact('title', 'errors'));
        }
    }
}