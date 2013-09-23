<?php
class Router
{
    public static $instance = null;
    public $default_controller = "IndexController";
    public $notfound_controller = "NotFoundController";

    public $routes = array( //Rewrite Rules
        'info' => 'InfoController',
        'poney' => 'PoneyController',
    );
    
    public function dispatch($rule)
    {
        if (isset($rule) && isset($this->routes[$rule]))
            $controller = $this->routes[$rule];
        else
            $controller = $this->notfound_controller;
        
        include_once(_CONTROLLERS_DIR_.'/'.$controller.".php");
        $class = new $controller();
        $class->run();
    }
    
    public static function getInstance()
    {
        if (!self::$instance)
            self::$instance = new Router();
        return self::$instance;
    }
    
    private function __construct()
    {
        $this->routes['index'] = $this->default_controller;
    }

}
