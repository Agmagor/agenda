<?php

class InfoController extends Controller
{
    public function __contruct()
    {
        parent::__construct();
    }
    public function run()
    {
        $this->smarty->assign("data", "Test controller");
        $this->smarty->display(_TPL_DIR_ . "info.tpl");
    }
}
