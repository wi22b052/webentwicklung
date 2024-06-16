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
            
            case "addtoCart":
                $res = $this->dh->addtoCart($param);
                break;
            
            case "addUser":
                $res = $this->dh->addUser($param);
                break;
            
            case "login":
                $res = $this->dh->login($param);
                break;
            
            case "logout":
                $res = $this->dh->logout();
                break;
            
            case "loadCart":
                $res = $this->dh->loadCart();
                break;

            case "loadProductByID":
                $res = $this->dh->loadProductByID($param);
                break;

            case "subtractfromCard":
                $res = $this->dh->subtractfromCard($param);
                break;
            
            case "searchProducts":
                $res = $this->dh->searchProducts($param);
                break;
            
            case "getUserData":
                $res = $this->dh->getUserData();
                break;
            
            case "updateUser":
                $res = $this->dh->updateUser($param);
                break;

            case "loadOrders":
                $res = $this->dh->loadOrders();
                break;

            case "loadOrderByID":
                $res = $this->dh->loadOrderByID($param);
                break;

            default:
                $res = null;
                break;
        }
        return $res;
    }
}
