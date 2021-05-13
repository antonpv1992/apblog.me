<?php


namespace app\controllers;


class ProfileController extends AppController
{
    /**
     *
     */
    public function indexAction()
    {
        $users = new \tools\core\mappers\UserMapper(\tools\core\Db::instance());
        $contacts = new \tools\core\mappers\ContactMapper(\tools\core\Db::instance());
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
            redirect('/');
        }
        $user = $users->getUsers("*", "user.login='$alias'")[0];
        $this->set(compact('title', 'user', 'alias', 'isAuth'));
    }
}