<?php

class Util //Singleton
{
    protected static $instance = null;
    
    public static function getInstance()
    {
        if (!self::$instance)
            self::$instance = new Util();
        return self::$instance;
    }
}