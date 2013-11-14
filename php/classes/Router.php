<?php
class Router
{
    protected static $instance = null;
    protected $default_controller = "IndexController";
    protected $notfound_controller = "NotFoundController";

    public $routes = array( //Rewrite Rules
        'info' => array(
            'controller' => 'InfoController',
        ),
        'poney' => array(
            'controller' => 'PoneyController',
        ),
        '#info/[0-9]+#' => array(
            'controller' => 'InfoController',
            'params' => array('id'),
        ),
        '#api/getcalendar/([a-z]{1})([0-9]{1})([a-z]{2,6})#' => array(
            'controller' => "GetCalendarController",
            'params' => array('controller','usr'),
        ),
        '#api/checkcalendar/([a-z]{1})([0-9]{1})([a-z]{2,6})#' => array(
            'controller' => "CheckCalendarController",
            'params' => array('controller','usr'),
        ),
        'api/eventdata/get' => array(
            'controller' => "EventDataController",
            'params' => array('controller','method'),
        ),
    );
    
    public function dispatch($url)
    {
        if (!isset($url)) die();
        if (isset($this->routes[$url])) //Simple url
            $controller = $this->routes[$url];
        else
        {
            $match = $this->match_rule($url);
            if ($match) //Regex route
            {
                $controller = $match;
            }
            else //Not found
                $controller = $this->routes[$this->notfound_controller];
        }
        
        $params = $this->build_params($url, $controller);
        
        include_once(_CONTROLLERS_DIR_.'/'.$controller['controller'].".php");
        $class = new $controller['controller']();
        $class->run($params);
    }
    
    public function match_rule($url) { //Find regex route
        foreach ($this->routes as $key => $route)
            if (@preg_match($key, $url))
                return $route;
        return false;
    }
    
    public function build_params($url, $route) //Build param array
    {
        $p_route = isset($route['params']) ? $route['params'] : array();
        $p_url = explode("/", $url);
        $res = array('page_name' => $p_url[0]);
        array_shift($p_url);
        foreach ($p_url as $key => $value)
            if (isset($p_route[$key]))
            $res[$p_route[$key]] = $value;
        return $res;
    }
    
    public static function getInstance()
    {
        if (!self::$instance)
            self::$instance = new Router();
        return self::$instance;
    }
    
    private function __construct()
    {
        $this->routes['index']['controller'] = $this->default_controller;
        $this->routes[$this->notfound_controller]['controller'] = $this->notfound_controller;
    }

}
