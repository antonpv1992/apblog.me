<?php

namespace tools\core;

//use app\models\user;

class App
{

    /** @var App attachment */
    public static App $app;

    /**
     * App constructor.
     */
    public function __construct()
    {
        $query = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/');
        Registry::auth();
        Router::dispatch($query);
    }
}