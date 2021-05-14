<?php


namespace app\controllers;


class RegistrationController extends AppController
{
    /**
     *
     */
    public function indexAction()
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
            $errors = \tools\core\FormValidation::validate($postData);
            if(empty($errors)){
                $this->registrationUser($postData);
                redirect('/');
            }
            $this->set(compact('title', 'errors'));
        }
    }
}