<?php


namespace tools\core\base;


class View
{
    /** @var array current route and options (controller, action, params) */
    public $route = [];

    /** @var bool|string current view */
    public $view;

    /** @var bool|string current layout */
    public $layout;

    /**
     * View constructor.
     * @param array $route
     * @param bool|string $layout
     * @param bool|string $view
     */
    public function __construct(array $route, bool|string $layout = '', bool|string $view = '')
    {
        $this->route = $route;
        if($layout === false){
            $this->layout = false;
        } else{
            $this->layout = $layout ?: LAYOUT;
        }
        $this->view = $view;
    }

    /**
     * method for display layout and view
     * @param null|array $userData
     */
    public function render(array|null $userData)
    {
        if(is_array($userData)) {
            extract($userData);
        }
        $file_view = APP . "/views/{$this->route['controller']}/" . lowerCamelCase($this->view) . ".php";
        ob_start();
        if(is_file($file_view)){
            require $file_view;
        } else{
            echo "<p>Не найден вид <b>$file_view</b></p>";
        }
        $content = ob_get_clean();
        if($this->layout !== false){
            $file_layout = APP . "/views/Layouts/{$this->layout}.php";
            if(is_file($file_layout)){
                require $file_layout;
            } else{
                echo "<p>Не найден шаблон <b>$file_layout</b></p>";
            }
        }
    }
}