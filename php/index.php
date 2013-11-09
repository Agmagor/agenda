<?php
include('./config/init.php'); //Init
if (!isset($_GET['url']))
    $_GET['url'] = 'index';

$a = explode('/',$_GET['url']);

if ($a[0] != "api")
    $smarty->display(_TPL_DIR_ . 'header.tpl');

Router::getInstance()->dispatch($_GET['url']);

if ($a[0] != "api")
    $smarty->display(_TPL_DIR_ . 'footer.tpl');
