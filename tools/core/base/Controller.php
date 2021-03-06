<?php

namespace tools\core\base;

abstract class Controller
{
    /** @var array current route and options (controller, action, params) */
    protected $route = [];

    /** @var bool|string view */
    protected $view;

    /** @var bool|string layout */
    protected $layout;

    /** @var array user data */
    protected $userData = [];

    /**
     * Controller constructor.
     * @param array $route
     */
    public function __construct(array $route)
    {
        $this->route = $route;
        $this->view = $route['action'];
    }

    /**
     * method for displaying the view, template and data
     */
    public function getView(): void
    {
        $object = new View($this->route, $this->layout, $this->view);
        $object->render($this->userData);
    }

    /**
     * method for forwarding data
     * @param array $userData data
     */
    public function set(array $userData): void
    {
        $this->userData = $userData;
    }
}