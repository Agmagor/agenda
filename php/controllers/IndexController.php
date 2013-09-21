<?php

class IndexController extends Controller
{
    public function __contruct()
    {
        parent::__construct();
    }
    public function run()
    {
        //$smarty = Context::getContext()->smarty;
        $this->smarty->assign('data', 'ohyeah');
        $this->smarty->display(_TPL_DIR_ . "index.tpl");
    }
}