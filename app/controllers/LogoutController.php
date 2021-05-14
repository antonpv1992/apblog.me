<?php


namespace app\controllers;


class LogoutController extends AppController
{
    /** @var bool  */
    protected $layout = false;

    /** @var bool  */
    protected $view = false;

    /**
     *
     */
    public function indexAction()
    {
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
            setcookie("user", "", time() - 3600);
        }
        redirect('/');
    }
}