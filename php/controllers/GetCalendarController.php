<?php

class GetCalendarController extends Controller
{
    public function __contruct()
    {
        parent::__construct();
    }
    public function run($params)
    {
        parent::run($params);
        //print_r($params);
        if ($params["usr"])
            Util::getInstance()->getCalendar($params["usr"]);
    }
}
