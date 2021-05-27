<?php

namespace tools\core\base;

class View
{

    /** @var array  */
    public array $route = [];

    /** @var bool|string  */
    public bool|string $view;

    /** @var bool|string  */
    public bool|string $layout;

    /**
     * View constructor.
     * @param array $route current rout
     * @param string $layout current layout
     * @param string $view current view
     */
    public function __construct(array $route, $layout = '', $view = '')
    {
        $this->route = $route;
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
        $this->view = $view;
    }

    /**
     * method for rendering data with current view and layout
     * @param array|string $userData data
     */
    public function render(array|string $userData): void
    {
        if (is_array($userData)) {
            extract($userData);
        }
        $file_view = APP . "/views/{$this->route['controller']}/" . lowerCamelCase($this->view) . ".php";
        ob_start();
        if (is_file($file_view)) {
            require $file_view;
        } else {
            redirect('/empty');
        }
        $content = ob_get_clean();
        if ($this->layout !== false) {
            $file_layout = APP . "/views/Layouts/{$this->layout}.php";
            if (is_file($file_layout)) {
                require $file_layout;
            } else{
                redirect('/empty');
            }
        }
    }
}