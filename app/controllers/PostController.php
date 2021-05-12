<?php


namespace app\controllers;


class PostController extends AppController
{
    public function indexAction(){
        $users = new \tools\core\mappers\UserMapper(\tools\core\Db::instance());
        $posts = new \tools\core\mappers\PostMapper(\tools\core\Db::instance());
        if($this->isLike($_POST, 'post, author, user, res')){
            $this->likeClick($users, $posts);
        }
        $title = "Single Post";
        $alias = explode('/',trim(explode('?', $_SERVER["REQUEST_URI"])[0], '/'));
        $currentId = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
        $post = $posts->getArticles("post.id, post.title, post.description, post.date, post.image, post.text, post.theme, post.likes, post.comments, post.alias, user.login as author, user.avatar, user.id as uid, activity.liked, activity.commented", $currentId, "post.alias='" . end($alias) . "'", "post.date DESC")[0];
        if(empty($post)){
            redirect('/');
        }
        $this->set(compact('title', 'post'));
    }
}