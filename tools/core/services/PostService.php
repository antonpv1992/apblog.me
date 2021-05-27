<?php 

namespace tools\core\services;

use tools\core\Db;
use tools\core\mappers\ActivityMapper;
use tools\core\mappers\PostMapper;
use tools\core\mappers\UserMapper;

trait PostService 
{
     /**
     * method for determining whether a post is liked or not
     * @param array $method an array containing keys
     * @param bool|string $str a string of keys to be checked in the array
     * @return bool returns true if all keys contain valid data
     */
    protected function isLike(array $method, $str = false): bool
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
     * method for writing like in the author db and post db
     * @param UserMapper $users user model mapper
     * @param PostMapper $posts post model mapper
     */
    protected function likeClick(UserMapper $users, PostMapper $posts): void
    {
        $_POST['user'] = $_SESSION['user']['id'];
        if($users->isExists("id='" . $_POST['user'] . "'") && $posts->isExists("id='" . $_POST['post'] . "'") && $users->isExists("id='" . $_POST['author'] . "'")){
            $amapper = new ActivityMapper(Db::instance());
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
            }
        }
    }

    /**
     * method for searching articles by title in the database
     * @param array $query query string split into an array
     * @return bool|string correct request or false
     */
    protected function searchTheme(array $query): bool|string
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