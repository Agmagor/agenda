<?php
class Router
{
    public static $routes = array( //Rewrite Rules
        'info' => 'InfoController',
        'poney' => 'PoneyController',
    );
    
    public static $default_controller = "IndexController";
    
    public static function dispatch($rule)
    {
        if (isset($rule) && isset(Router::$routes[$rule]))
            $controller = Router::$routes[$rule];
        else
            $controller = Router::$default_controller;
        
        include_once(_CONTROLLERS_DIR_.'/'.$controller.".php");
        $class = new $controller();
        $class->run();
    }
}
