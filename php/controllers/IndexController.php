<?php

class IndexController extends Controller
{
    public function __contruct()
    {
        parent::__construct();
    }
    public function run($params)
    {
        parent::run($params);
        $this->smarty->assign('data', 'ohyeah');
        $this->smarty->display(_TPL_DIR_ . "index.tpl");
    }
}