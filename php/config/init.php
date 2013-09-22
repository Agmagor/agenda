<?php

session_start();
//header("Cache-Control: no-cache");

require('defines.inc.php');
require(_PATH_ . 'tools/smarty/Smarty.class.php');

$files = scandir(_CLASSES_DIR_);
foreach ($files as $filename)
    if (is_file(_CLASSES_DIR_.$filename))
        require_once(_CLASSES_DIR_.$filename);

/*try
{
    $bdd = new PDO("mysql:host=localhost;dbname=pixyjob", "root", "");
    $bdd->query("SET NAMES UTF8");
} catch (Exception $e)
{
    echo "Problème de connexion à la base de donnée PixyJob...";
    die();
}*/

// Smarty init
global $smarty;
$smarty = new Smarty();
$smarty->setCompileDir(_CACHE_DIR_.'smarty/compile');
$smarty->setCacheDir(_CACHE_DIR_.'smarty/cache');
$smarty->caching = false;
$smarty->force_compile = false;
$smarty->compile_check = true;

Context::getContext()->smarty = $smarty;