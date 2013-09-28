<?php

class InfoController extends Controller
{
    public function __contruct()
    {
        parent::__construct();
    }
    public function run($params)
    {
        parent::run($params);
        $this->smarty->assign("data", $params['id']);
        $this->smarty->display(_TPL_DIR_ . "info.tpl");
    }
}
