<?php
include('./config/init.php'); //Init
if (!isset($_GET['url']))
    $_GET['url'] = 'index';

$smarty->display(_TPL_DIR_ . 'header.tpl');

Router::getInstance()->dispatch($_GET['url']);

$smarty->display(_TPL_DIR_ . 'footer.tpl');
