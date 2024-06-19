<?php
// Einbinden der Datei "dataHandler.php", die die Klasse DataHandler definiert
include("config/dataHandler.php");

class SimpleLogic
{
    // Private Eigenschaft für die DataHandler-Instanz
    private $dh;

    // Konstruktor, der beim Instanziieren der Klasse automatisch ein DataHandler-Objekt erstellt
    function __construct()
    {
        $this->dh = new DataHandler();
    }

    // Methode zur Behandlung von Anfragen basierend auf der Methode und den Parametern
    function handleRequest($method, $param)
    {
        // Switch-Case-Konstrukt, um die Methode basierend auf dem Parameter $method auszuführen
        switch ($method) {
            case "queryProducts":
                // Abrufen aller Produkte
                $res = $this->dh->queryProducts();
                break;
            
            case "queryProductsByCategory":
                // Abrufen der Produkte nach Kategorie
                $res = $this->dh->queryProductsByCategory($param);
                break;
            
            case "addtoCart":
                // Hinzufügen eines Produkts zum Warenkorb
                $res = $this->dh->addtoCart($param);
                break;
            
            case "addUser":
                // Hinzufügen eines neuen Benutzers
                $res = $this->dh->addUser($param);
                break;
            
            case "login":
                // Benutzeranmeldung
                $res = $this->dh->login($param);
                break;
            
            case "logout":
                // Benutzerabmeldung
                $res = $this->dh->logout();
                break;
            
            case "loadCart":
                // Laden des Warenkorbs
                $res = $this->dh->loadCart();
                break;

            case "loadProductByID":
                // Laden eines Produkts nach ID
                $res = $this->dh->loadProductByID($param);
                break;

            case "subtractfromCard":
                // Entfernen eines Produkts aus dem Warenkorb
                $res = $this->dh->subtractfromCard($param);
                break;
            
            case "searchProducts":
                // Suchen von Produkten
                $res = $this->dh->searchProducts($param);
                break;
            
            case "getUserData":
                // Abrufen der Benutzerdaten
                $res = $this->dh->getUserData();
                break;
            
            case "updateUser":
                // Aktualisieren der Benutzerdaten
                $res = $this->dh->updateUser($param);
                break;

            case "loadOrders":
                // Laden aller Bestellungen eines Benutzers
                $res = $this->dh->loadOrders();
                break;

            case "loadOrderByID":
                // Laden einer Bestellung nach ID
                $res = $this->dh->loadOrderByID($param);
                break;

            case "editProduct":
                // Bearbeiten eines Produkts
                $res = $this->dh->editProduct($param);
                break;

            case "deleteProduct":
                // Löschen eines Produkts
                $res = $this->dh->deleteProduct($param);
                break;
            
            case "addProduct":
                // Hinzufügen eines neuen Produkts
                $res = $this->dh->addProduct($param);
                break;
            
            case "order":
                // Erstellen einer neuen Bestellung
                $res = $this->dh->order();
                break;
            
            case "addCartToOrder":
                // Hinzufügen des Warenkorbs zu einer Bestellung
                $res = $this->dh->addCartToOrder($param);
                break;
            
            default:
                // Standardfall, wenn die Methode nicht erkannt wird
                $res = null;
                break;
        }
        // Rückgabe des Ergebnisses der ausgeführten Methode
        return $res;
    }
}
