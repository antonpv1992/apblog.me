<?php


namespace app\controllers;


use tools\core\base\Controller;

class AppController extends Controller
{
    /**
     * @param $method
     * @param $str
     * @return bool
     */
    protected function isLike($method, $str = false)
    {
        $arr = ($str !== false) ? explode(',', $str) : [];
        foreach($arr as $value) {
            if(!isset($method[trim($value)]) || !is_numeric($method[trim($value)])) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param $users
     * @param $posts
     */
    protected function likeClick($users, $posts)
    {
        $_POST['user'] = $_SESSION['user']['id'];
        if($users->isExists("id='" . $_POST['user'] . "'") && $posts->isExists("id='" . $_POST['post'] . "'") && $users->isExists("id='" . $_POST['author'] . "'")){
            $amapper = new \tools\core\mappers\ActivityMapper(\tools\core\Db::instance());
            $like = 0;
            if($_POST['res'] === '1'){
                $like = 1;
                $users->update("likes = likes + 1", "id=" .  $_POST['author']);
                $posts->update("likes = likes + 1", "id=" .  $_POST['post']);
            } else {
                $users->update("likes = likes - 1", "id=" .  $_POST['author']);
                $posts->update("likes = likes - 1", "id=" .  $_POST['post']);
            }
            if($amapper->isExists("post=" . $_POST['post'] . " AND user=" . $_POST['user'] . "")){
                $amapper->setActivity("liked=$like", "post=" . $_POST['post'] . " AND user=" . $_POST['user']);
            } else {
                $amapper->addActivity(["post" => $_POST['post'],"user" => $_POST['user'] ,"liked" => 1]);
            };
        }
    }


    protected function searchTheme($query)
    {
        if(isset($_POST['query'])){
            setcookie("SearchQuery", $_POST['query'], time()+120);
        }
        if(isset($_POST['query'])){
            return "post.title LIKE '%". hsc($_POST['query']) . "%'";
        } else if(isset($_COOKIE["SearchQuery"]) && end($query) === 'search') {
            return "post.title LIKE '%". hsc($_COOKIE["SearchQuery"]) . "%'";
        } else if(end($query) !== 'posts' && end($query) !== ''){
            return "post.theme='" . end($query) . "'";
        } else {
            return false;
        }
    }
}