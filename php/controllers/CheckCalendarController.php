<?php

class CheckCalendarController extends Controller
{
    private static $reg = "/^([a-z]{1})([0-9]{1})([a-z]{2,6})$/";
    
    public function __contruct()
    {
        parent::__construct();
    }
    public function run($params)
    {
        parent::run($params);
        if (isset($params["usr"]))
            $this->checkCalendar($params["usr"]);
    }
    protected function checkUsername($usr)
    {
        return preg_match(self::$reg, $usr);
    }
    
    protected function getCalendarURI($usr)
    {
        return "http://edt.enib.fr/ics.php?username=" . $usr . "&pass='" . base64_encode($usr) . "'&t=".time();
    }
    
    protected function checkCalendar($usr)
    {
        /*stream_context_set_default(
            array(
                'http' => array(
                    'method' => 'HEAD'
                )
            )
        );*/ //HEAD request doesn't show content-length
        $headers = get_headers($this->getCalendarURI($usr));
        
        $res["error"] = 0;
        
        if (isset($headers[9]) && $headers[9] == "Content-Length: 0")
            $res["error"] = 1;
        
        header('Content-type: application/json');
            exit(json_encode($res));
    }
}
