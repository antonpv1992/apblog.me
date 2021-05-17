<?php


namespace app\controllers;


class EmptyController extends AppController
{

    /**
     * 404 page
     */
    public function indexAction(): void
    {
        $title = '404';
        http_response_code(404);
        $this->set(compact('title'));
    }
}