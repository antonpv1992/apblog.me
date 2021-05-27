<?php

namespace app\controllers;

use tools\core\Db;
use tools\core\mappers\PostMapper;
use tools\core\mappers\UserMapper;
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
        $users = new UserMapper(Db::instance());
        $posts = new PostMapper(Db::instance());
        if($this->isLike($_POST, 'post, author, user, res')){
            $this->likeClick($users, $posts);
        }
        $title = 'Posts';
        $query = explode('/',trim(explode('?', $_SERVER["REQUEST_URI"])[0], '/'));
        $theme = $this->searchTheme($query);
        $total = $theme !== false ? $posts->countRecords($theme) : $posts->countRecords();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 1;
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $currentId = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
        $articles = $posts->getArticles("post.id, post.title, post.description, post.date, post.image, post.short_text, post.theme, post.likes, post.comments, post.alias, user.login as author, user.avatar, user.id as uid, activity.liked, activity.commented", $currentId, $theme, "post.date DESC", "$start, $perpage");
        $populars = $posts->getArticles("post.title, post.date, post.image, post.alias, user.login as author, user.avatar", false, false, "post.likes DESC", 5);
        $liked = $posts->getArticles("post.title, post.date, post.image, post.alias, activity.liked", $currentId, "activity.liked = 1", "post.date DESC", 5);
        $authors = $users->getUsers('user.login, user.likes, user.avatar', "user.author=1", "user.likes DESC", 5);
        $this->set(compact('title', 'articles', 'populars', 'liked', 'authors', 'pagination'));
    }
}