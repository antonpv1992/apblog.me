<?php


namespace tools\core\base;


abstract class Controller
{
    /** @var array current route and options (controller, action, params) */
    protected $route = [];

    /** @var string view*/
    protected $view;

    /** @var string layout*/
    protected $layout;

    /** @var array user data */
    protected $userData = [];

    public function __construct(array $route)
    {
        $this->route = $route;
        $this->view = $route['action'];
    }

    /**
     * method for displaying the view, template and data
     */
    public function getView()
    {
        $object = new View($this->route, $this->layout, $this->view);
        $object->render($this->userData);
    }

    /**
     * method for forwarding data
     * @param $userData
     */
    public function set($userData)
    {
        $this->userData = $userData;
    }
}