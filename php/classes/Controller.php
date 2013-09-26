<?php
class Controller {
    protected $smarty;
    
    public function __construct()
    {
        $this->smarty = Context::getContext()->smarty;
        $this->smarty->assign(array(
            'tpl_dir'    =>  _TPL_URI_,
            'css_dir'    =>  _CSS_URI_,
            'img_dir'    =>  _IMG_URI_,
            'js_dir'     =>  _JS_URI_
        ));
    }
    
    public function run($params)
    {
        if (isset($params[0]))
            $this->smarty->assign("page_name", $params[0]);
    }
}