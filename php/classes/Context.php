<?php
class Context
{
    public $smarty;
    public static $instance;
    
    public static function getContext()
    {
		if (!isset(self::$instance))
			self::$instance = new Context();
		return self::$instance;
	}
}