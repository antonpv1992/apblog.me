<?php

namespace app\controllers;

use tools\core\Db;
use tools\core\mappers\ContactMapper;
use tools\core\mappers\UserMapper;
use tools\core\services\UserService;

class ProfileController extends AppController
{

    use UserService;

    /**
     * main page Profile
     */
    public function indexAction(): void
    {
        $users = new UserMapper(Db::instance());
        $contacts = new ContactMapper(Db::instance());
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $this->changeUserData($users, $contacts);
        }
        $title = "Profile";
        $alias = explode('/', trim($_SERVER["REQUEST_URI"], '/'));
        $isAuth = false;
        if(end($alias) === 'profile' && isset($_SESSION['user'])){
            $alias = strtolower($_SESSION['user']['login']);
            $isAuth = true;
        } else if($users->isUserExists(end($alias))){
            $alias = end($alias);
        } else {
            redirect('/empty');
        }
        $user = $users->getUsers("*", "user.login='$alias'")[0];
        $this->set(compact('title', 'user', 'alias', 'isAuth'));
    }
}