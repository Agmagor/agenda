<?php

class NotFoundController extends Controller
{
    public function __contruct()
    {
        parent::__construct();
    }
    public function run($params)
    {
        parent::run($params);
        $this->smarty->display(_TPL_DIR_ . "404.tpl");
    }
}
