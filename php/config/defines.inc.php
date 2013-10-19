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

define('_CSS_DIR_', _PATH_ . 'public/css/');

define('_JS_DIR_', _PATH_ . 'public/js/');

define('_IMG_DIR_', _PATH_ . 'public/img/');

define('_LOGS_DIR_', _PATH_ . 'logs/');

define ('_CACHE_DIR_', _PATH_ . 'cache/');

//URIs

$base_uri = $_SERVER["HTTP_HOST"]; //Force $_SERVER init despite auto_globals_jit
define('_BASE_URI_', $base_uri . "/");

define('_TPL_URI_', _BASE_URI_ . 'public/tpl/');

define('_CSS_URI_', _BASE_URI_ . 'public/css/');

define('_JS_URI_', _BASE_URI_ . 'public/js/');

define('_IMG_URI_', _BASE_URI_ . 'public/img/');