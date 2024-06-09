<?php
include("config/dataHandler.php");

class SimpleLogic
{

    private $dh;

    function __construct()
    {
        $this->dh = new DataHandler();
    }

    function handleRequest($method, $param)
    {
        switch ($method) {
            case "queryProducts":
                $res = $this->dh->queryProducts();
                break;
            
            case "queryProductsByCategory":
                $res = $this->dh->queryProductsByCategory($param);
                break;

            default:
                $res = null;
                break;
        }
        return $res;
    }
}
