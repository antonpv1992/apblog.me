<?php

namespace tools\core\services;

use app\models\Post;

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
            if (!isset($method[trim($value)]) || !is_numeric($method[trim($value)])) {
                return false;
            }
        }
        return true;
    }

    /**
     * method for writing like in the author db and post db
     * @param Post $postObj post model object
     */
    protected function likeClick(Post $postObj): void
    {
        $_POST['user'] = $_SESSION['user']['id'];
        if ($postObj->postAndAuthorExists()) {
            $postObj->toggleLike($_POST);
        }
    }

    /**
     * method for searching articles by title in the database
     * @param array $query query string split into an array
     * @return bool|string correct request or false
     */
    protected function searchTheme(array $query): bool|string
    {
        if (isset($_POST['query'])) {
            setcookie("SearchQuery", $_POST['query'], time()+120);
        }
        if (isset($_POST['query'])) {
            return "post.title LIKE '%". hsc($_POST['query']) . "%'";
        } elseif (isset($_COOKIE["SearchQuery"]) && end($query) === 'search') {
            return "post.title LIKE '%". hsc($_COOKIE["SearchQuery"]) . "%'";
        } elseif (end($query) !== 'posts' && end($query) !== '') {
            return "post.theme='" . end($query) . "'";
        } else {
            return false;
        }
    }
}