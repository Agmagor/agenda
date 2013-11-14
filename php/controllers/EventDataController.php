<?php

class EventDataController extends Controller
{    
    public function __contruct()
    {
        parent::__construct();
    }
    public function run($params)
    {
        parent::run($params);
        if (isset($params["method"]))
        {
            if ($params["method"] == "get")
            {
                $this->getEventData($_REQUEST["request"]);
            }
            else if ($params["method"] == "set")
            {
                
            }
        }
    }
    protected function getEventData($uids)
    {
        $uids = json_decode(stripslashes($uids), TRUE);
        //print_r($uids);
        $placeholders = rtrim(str_repeat('?, ', count($uids)), ', ') ;
        $bdd = $this->connectDB();
        $query = "SELECT uid,data,date FROM event_data WHERE uid IN($placeholders)";
        
        $stm = $bdd->prepare($query);
        $res = array();
        if ($stm->execute($uids))
        {
            while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                array_push($res, $row);
            }
            header('Content-type: application/json');
            exit(json_encode($res));
        }
    }
    
    protected function setEventData()
    {
        
    }
    
    protected function connectDB()
    {
        try
        {
            $bdd = new PDO("mysql:host=". _DB_SERVER_ .";dbname=". _DB_NAME_, _DB_USER_, _DB_PASSWD_);
            $bdd->query("SET NAMES UTF8");
            return $bdd;
        } catch (Exception $e)
        {
            die();
        }
    }
    
    protected function closeDB($bdd)
    {
        $bdd = null;
    }
}