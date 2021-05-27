<?php

namespace app\controllers;

use tools\core\services\PostService;

class PostsController extends AppController
{

    use PostService;

    /**
     * main page Posts
     */
    public function indexAction(): void
    {
        if ($this->isLike($_POST, 'post, author, user, res')) {
            $this->likeClick();
        }
        $title = 'Posts';
        $query = explode('/',trim(explode('?', $_SERVER["REQUEST_URI"])[0], '/'));
        $theme = $this->searchTheme($query);
        extract($this->initializationPagination($theme));
        $articles = $this->allPosts($currentId, $theme, $start, $perpage);
        $populars = $this->popularsPosts();
        $liked = $this->likedPosts($currentId);
        $authors = $this->topAuthors();
        $this->set(compact('title', 'articles', 'populars', 'liked', 'authors', 'pagination'));
    }
}