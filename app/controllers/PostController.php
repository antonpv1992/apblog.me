<?php

namespace app\controllers;

use tools\core\Db;
use tools\core\mappers\PostMapper;
use tools\core\mappers\UserMapper;

class PostController extends AppController
{

    /**
     * main page Post
     */
    public function indexAction(): void
    {
        $users = new UserMapper(Db::instance());
        $posts = new PostMapper(Db::instance());
        if($this->isLike($_POST, 'post, author, user, res')){
            $this->likeClick($users, $posts);
        }
        $title = "Single Post";
        $alias = explode('/',trim(explode('?', $_SERVER["REQUEST_URI"])[0], '/'));
        $currentId = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
        if($posts->getArticles("post.id, post.title, post.description, post.date, post.image, post.text, post.theme, post.likes, post.comments, post.alias, user.login as author, user.avatar, user.id as uid, activity.liked, activity.commented", $currentId, "post.alias='" . end($alias) . "'", "post.date DESC")){
            $post = $posts->getArticles("post.id, post.title, post.description, post.date, post.image, post.text, post.theme, post.likes, post.comments, post.alias, user.login as author, user.avatar, user.id as uid, activity.liked, activity.commented", $currentId, "post.alias='" . end($alias) . "'", "post.date DESC")[0];
        } else {
            redirect('/empty');
        }
        $this->set(compact('title', 'post'));
    }
}