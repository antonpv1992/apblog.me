<?php

namespace app\controllers;

use tools\core\services\UserService;

class ProfileController extends AppController
{

    use UserService;

    /**
     * main page Profile
     */
    public function indexAction(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->changeUserData();
        }
        $title = "Profile";
        $alias = explode('/', trim($_SERVER["REQUEST_URI"], '/'));
        $isAuth = false;
        if (end($alias) === 'profile' && isset($_SESSION['user'])) {
            $alias = strtolower($_SESSION['user']['login']);
            $isAuth = true;
        } elseif ($this->isUserByLogin(end($alias))) {
            $alias = end($alias);
        } else {
            redirect('/empty');
        }
        $user = $this->getUserByLogin($alias);//$userObj->getByLogin($alias);
        $this->set(compact('title', 'user', 'alias', 'isAuth'));
    }
}