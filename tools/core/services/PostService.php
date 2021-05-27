<?php

namespace tools\core\services;

use app\models\Post;
use tools\core\Pagination;

trait PostService
{

     /**
     * method for determining whether a post is liked or not
     * @param array $method an array containing keys
     * @param bool|string $str a string of keys to be checked in the array
     * @return bool returns true if all keys contain valid data
     */
    public function isLike(array $method, $str = false): bool
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
     */
    public function likeClick(): void
    {
        $post = new Post([]);
        $_POST['user'] = $_SESSION['user']['id'];
        if ($post->postAndAuthorExists()) {
            $post->toggleLike($_POST);
        }
    }

    /**
     * method for searching articles by title in the database
     * @param array $query query string split into an array
     * @return bool|string correct request or false
     */
    public function searchTheme(array $query): bool|string
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

    /**
     * method that returns the correct post by alias
     * @param string|int $currentId id
     * @param string $alias alias
     * @return Post current post
     */
    public function getCurrentPost(string|int $currentId, string $alias): Post
    {
        $post = new Post([]);
        return $post->getSinglePost($currentId, $alias);
    }

    /**
     * method for checking whether a post exists
     * @param string|int $currentId id
     * @param string $alias alias
     * @return bool true if exists
     */
    public function postExists(string|int $currentId, string $alias): bool
    {
        $post = new Post([]);
        return $post->postExists($currentId, $alias);
    }

    /**
     * method to initialize pagination
     * @param string|bool $theme theme
     * @return array pagination and options
     */
    public function initializationPagination(string|bool $theme): array
    {
        $total = $this->postsCount($theme);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 1;
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $currentId = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
        return compact('pagination', 'total', 'page', 'perpage', 'start', 'currentId');
    }

    /**
     * method that returns the number of posts
     * @param string|bool $theme theme
     * @return int|string number of posts
     */
    public function postsCount(string|bool $theme): int|string
    {
        $post = new Post([]);
        return $post->postOnPages($theme);
    }

    /**
     * method that returns all posts by condition
     * @param int|string $currentId id
     * @param string|bool $theme theme
     * @param int|string $start start(for pagination)
     * @param int|string $perpage number of posts on page(for pagination)
     * @return array posts
     */
    public function allPosts(int|string $currentId, string|bool $theme, int|string $start, int|string $perpage): array
    {
        $post = new Post([]);
        return $post->getAllPosts($currentId, $theme, $start, $perpage);
    }

    /**
     * the method returns popular posts
     * @return array posts
     */
    public function popularsPosts(): array
    {
        $post = new Post([]);
        return $post->getPopularPosts();
    }

    /**
     * method returns liked posts
     * @param int|string $currentId id
     * @return array posts
     */
    public function likedPosts(int|string $currentId): array
    {
        $post = new Post([]);
        return $post->getLikedPosts($currentId);
    }

    /**
     * method that returns the top author
     * @return array authors
     */
    public function topAuthors(): array
    {
        $user = new \app\models\User([]);
        return $user->getTopAuthors();
    }
}