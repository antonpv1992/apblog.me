<?php


namespace app\controllers;


class PostsController extends AppController
{
    public function indexAction()
    {
        $title = 'Posts';
        $posts = new \tools\core\mappers\PostMapper(\tools\core\Db::instance());
        $users = new \tools\core\mappers\UserMapper(\tools\core\Db::instance());
        $this->set(compact('title', 'posts', 'users' ));
    }
}