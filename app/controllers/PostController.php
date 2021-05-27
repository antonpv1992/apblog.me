<?php

namespace app\controllers;

use app\models\Post;
use tools\core\services\PostService;

class PostController extends AppController
{

    use PostService;

    /**
     * main page Post
     */
    public function indexAction(): void
    {
        $postObj = new Post([]);
        if ($this->isLike($_POST, 'post, author, user, res')) {
            $this->likeClick($postObj);
        }
        $title = "Single Post";
        $alias = explode('/', trim(explode('?', $_SERVER["REQUEST_URI"])[0], '/'));
        $currentId = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
        if (!$postObj->postExists($currentId, end($alias))) {
            redirect('/empty');
        }
        $post = $postObj->getSinglePost($currentId, end($alias));
        $this->set(compact('title', 'post'));
    }
}