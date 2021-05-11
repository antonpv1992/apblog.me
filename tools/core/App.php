<?php


namespace tools\core;


class App
{
    /** @var self main app */
    public static $app;

    /**
     * App constructor.
     */
    public function __construct()
    {
        $query = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/');
        Router::dispatch($query);
    }
}