<?php
class Controller {
    protected $smarty;
    
    public function __construct()
    {
        $this->smarty = Context::getContext()->smarty;
    }
}