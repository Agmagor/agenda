<?php
include('./config/init.php'); //Init
if (!isset($_GET['a']))
    $_GET['a'] = 'index';

$smarty->display(_TPL_DIR_ . 'header.tpl');

//$smarty->display(_TPL_DIR_ . $_GET['a'] . ".tpl");
Router::dispatch($_GET['a']);

$smarty->display(_TPL_DIR_ . 'footer.tpl');