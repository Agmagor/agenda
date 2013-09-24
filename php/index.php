<?php
include('./config/init.php'); //Init
if (!isset($_GET['a']))
    $_GET['a'] = 'index';

$smarty->display(_TPL_DIR_ . 'header.tpl');

Router::getInstance()->dispatch($_GET['a']);

$smarty->display(_TPL_DIR_ . 'footer.tpl');
