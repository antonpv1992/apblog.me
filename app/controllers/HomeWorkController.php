<?php

namespace app\controllers;

class HomeWorkController extends AppController
{

    /** @var bool|string current layout */
    protected $layout = 'homework';

    /** @var string current title */
    private string $title = 'Mysite.loc';

    /**
     * main page HomeWork
     */
    public function indexAction(): void
    {
        if (!isset($_SESSION['user'])) {
            redirect('/empty');
        }
        $title = $this->title;
        $this->set(compact('title'));
    }

    /**
     * action page HomeWork
     */
    public function actionAction(): void
    {
        if (!isset($_SESSION['user'])) {
            redirect('/empty');
        }
        $title = $this->title;
        $this->set(compact('title'));
    }
}