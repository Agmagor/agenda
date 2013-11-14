<?php

class GetCalendarController extends Controller
{
    private static $reg = "/^([a-z]{1})([0-9]{1})([a-z]{2,6})$/";
    
    public function __contruct()
    {
        parent::__construct();
    }
    public function run($params)
    {
        parent::run($params);
        //print_r($params);
        if (isset($params["usr"]))
            $this->getCalendar($params["usr"]);
    }
    protected function checkUsername($usr)
    {
        return preg_match(self::$reg, $usr);
    }
    
    protected function getCalendarURI($usr)
    {
        return "http://edt.enib.fr/ics.php?username=" . $usr . "&pass='" . base64_encode($usr) . "'&t=".time();
    }
    
    protected function getCalendar($usr)
    {
        if ($this->checkUsername($usr))
        {
            if ($this->getCalendarURI($usr))
            {
                $response["error"] = 0;
                $response["timestamp"] = time();
                $cal = new CalFileParser();
                $response["data"] = json_decode($cal->parse($this->getCalendarURI($usr), 'json'));
                $encoded = json_encode($response);
                header('Content-type: application/json');
                exit($encoded);
                /*$cal = new CalFileParser();
                $response = $cal->parse($this->getCalendarURI($usr), 'json');
                header('Content-type: application/json');
                exit($response);*/
            }
            else
            {
                $response["error"] = "url error";
            }
        }
        else
        {
            $response["error"] = "usr error";
        }
    }
}

