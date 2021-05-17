<?php

namespace app\controllers;

class LogoutController extends AppController
{

    /** @var bool|string current layout */
    protected $layout = false;

    /** @var bool|string current view */
    protected $view = false;

    /**
     * main action logout
     */
    public function indexAction(): void
    {
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
            setcookie("user", "", time() - 3600);
        }
        redirect('/');
    }
}