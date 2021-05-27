<?php

namespace tools\core;

class Router
{

    /** @var array of routes */
    protected static array $routes = [];

    /** @var array of current route and options (controller, action, params) */
    protected static array $route = [];

    /**
     * method adding a route to the route table
     * @param string $regexp route name regular expression
     * @param array $route current array of route options
     */
    public static function add(string $regexp, array $route = []): void
    {
        self::$routes[$regexp] = $route;
    }

    /**
     * method for getting an array of routes
     * @return array an array of routes
     */
    public static function getRoutes(): array
    {
        return self::$routes;
    }

    /**
     * method for getting a current route
     * @return array option an array of route
     */
    public static function getRoute(): array
    {
        return self::$route;
    }

    /**
     * search for a route by request in an array of routes
     * @param string $url query
     * @return bool is a route found
     */
    public static function matchRoute(string $url): bool
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                self::$route = self::getCurrentRoute($matches, $route);
                return true;
            }
        }
        return false;
    }

    /**
     * method generating the correct route
     * @param $routes array of routes
     * @param $route array of route
     * @return array current route
     */
    private static function getCurrentRoute(array $routes, array $route): array
    {
        foreach ($routes as $key => $value) {
            if (is_string($key)) {
                $route[$key] = $value;
            }
        }
        if (!isset($route['action'])) {
            $route['action'] = 'index';
        }
        $route['controller'] = upperCamelCase($route['controller']);
        return $route;
    }

    /**
     * redirects the URL to the correct route
     * @param string $url query
     */
    public static function dispatch(string $url): void
    {
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['controller'] . 'Controller';
            if (class_exists($controller)) {
                $object = new $controller(self::$route);
                $action = lowerCamelCase(self::$route['action']) . 'Action';
                if (method_exists($object, $action)) {
                    $object->$action();
                    $object->getView();
                } else {
                    redirect('/empty');
                }
            } else {
                redirect('/empty');
            }
        } else {
            redirect('/empty');
        }
    }
}