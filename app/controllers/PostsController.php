<?php

namespace app\controllers;

use app\models\Post;
use app\models\User;
use tools\core\Pagination;
use tools\core\services\PostService;

class PostsController extends AppController
{

    use PostService;

    /**
     * main page Posts
     */
    public function indexAction(): void
    {
        $postObj = new Post([]);
        $userObj = new User([]);
        if ($this->isLike($_POST, 'post, author, user, res')) {
            $this->likeClick($postObj);
        }
        $title = 'Posts';
        $query = explode('/',trim(explode('?', $_SERVER["REQUEST_URI"])[0], '/'));
        $theme = $this->searchTheme($query);
        $total = $postObj->postOnPages($theme);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 1;
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $currentId = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
        $articles = $postObj->getAllPosts($currentId, $theme, $start, $perpage);
        $populars = $postObj->getPopularPosts();
        $liked = $postObj->getLikedPosts($currentId);
        $authors = $userObj->getTopAuthors();
        $this->set(compact('title', 'articles', 'populars', 'liked', 'authors', 'pagination'));
    }
}