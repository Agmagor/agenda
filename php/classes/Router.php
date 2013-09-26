<?php
class Router
{
    public static $instance = null;
    public $default_controller = "IndexController";
    public $notfound_controller = "NotFoundController";

    public $routes = array( //Rewrite Rules
        'info' => 'InfoController',
        'poney' => 'PoneyController',
        '#info/[0-9]+#' => 'InfoController',
    );
    
    public function dispatch($url)
    {
        if (!isset($url)) die;
        $params = explode("/", $url);
        if (isset($this->routes[$url]))
            $controller = $this->routes[$url];
        else
        {
            $match = $this->match_rule($url);
            if ($match)
            {
                $controller = $match[0];
                $params = $match[1];
            }
            else
                $controller = $this->notfound_controller;
        }
        
        include_once(_CONTROLLERS_DIR_.'/'.$controller.".php");
        $class = new $controller();
        $class->run($params);
    }
    
    public function match_rule($url) {
        foreach($this->routes as $key => $route)
            if (preg_match($key, $url))
                return array($route, explode('/', $url));
        return false;
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
