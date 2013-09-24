<?php

//if (!isset($_SERVER['DOCUMENT_ROOT'])) //Won't work with php-fpm
//    die();

$currentDir = dirname(__FILE__);

//define('_PATH_', $_SERVER['DOCUMENT_ROOT'].'/');
define('_PATH_', $currentDir.'/../');

define('_CLASSES_DIR_', _PATH_ . 'classes/');

define('_CONTROLLERS_DIR_', _PATH_ . 'controllers/');

define('_CONFIG_DIR_', _PATH_ . 'config/');

define('_TPL_DIR_', _PATH_ . 'public/tpl/');

define('_LOGS_DIR_', _PATH_ . 'logs/');

define ('_CACHE_DIR_', _PATH_ . 'cache/');
