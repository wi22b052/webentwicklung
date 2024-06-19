<?php
// Einbinden der benötigten Modellklassen
include("./models/product.class.php");
include("./models/user_all.php");
include("./models/order.php");

class DataHandler
{
    // Private Eigenschaft für die Datenbankverbindung
    private $db;

    // Konstruktor, der beim Instanziieren der Klasse automatisch die Datenbankverbindung herstellt
    public function __construct()
    {
        $this->db = $this->connectDB();
    }

    // Private Methode zur Herstellung der Datenbankverbindung
    private function connectDB()
    {
        try {
            // Datenbankverbindungsparameter
            $host = "localhost";
            $dbname = "webshop";
            $username = "username";
            $password = "password"; 
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

            // PDO-Objekt für die Verbindung zur Datenbank erstellen und zurückgeben
            return new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            // Fehlermeldung bei Verbindungsfehler ausgeben und das Skript beenden
            echo 'Connection failed: ' . $e->getMessage();
            exit;
        }
    }

    // Methode zum Abrufen aller Produkte aus der Datenbank
    public function queryProducts()
    {
        // SQL-Abfrage zum Abrufen aller Produkte ausführen
        $stmt = $this->db->query('SELECT * FROM products');
        // Ergebnisse der Abfrage als Array abrufen
        $res = $stmt->fetchAll();
        // Leeres Array zum Speichern der Produktobjekte
        $products = [];

        // Durch die Ergebnisse iterieren und jedes Ergebnis in ein Produktobjekt umwandeln
        foreach ($res as $row){
            $products[] = new Product(
                $row['id'],
                $row['name'],
                $row['price'],
                $row['description'],
                $row['stock'],
                $row['created_at'],
                $row['category']
            );
        }
        // Array der Produktobjekte zurückgeben
        return $products;
    }

    // Methode zum Abrufen von Produkten nach Kategorie aus der Datenbank
    public function queryProductsByCategory($param)
    {
        // SQL-Abfrage zum Abrufen der Produkte nach Kategorie ausführen
        $stmt = $this->db->query("SELECT * FROM `products` WHERE `category` = '$param'");
        // Ergebnisse der Abfrage als Array abrufen
        $res = $stmt->fetchAll();
        // Leeres Array zum Speichern der Produktobjekte
        $products = [];

        // Durch die Ergebnisse iterieren und jedes Ergebnis in ein Produktobjekt umwandeln
        foreach ($res as $row){
            $products[] = new Product(
                $row['id'],
                $row['name'],
                $row['price'],
                $row['description'],
                $row['stock'],
                $row['created_at'],
                $row['category']
            );
        }
        // Array der Produktobjekte zurückgeben
        return $products;
    }

    // Methode zum Hinzufügen eines Produkts zum Warenkorb (in der Sitzung gespeichert)
    public function addtoCart($param)
    {
        // Sitzung starten, falls noch nicht gestartet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Prüfen, ob der Warenkorb in der Sitzung existiert und ein Array ist, ansonsten initialisieren
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        // Produkt zum Warenkorb hinzufügen
        $_SESSION['cart'][] = $param;
        // Anzahl der Elemente im Warenkorb zurückgeben
        $elemente_in_Warenkorb = count($_SESSION['cart']);
        return $elemente_in_Warenkorb;
    }

    // Methode zum Hinzufügen eines Benutzers zur Datenbank
    public function addUser($param)
{
    try {
        // Passwort hashen mit bcrypt Algorithmus
        $hashedPassword = password_hash($param['pword'], PASSWORD_BCRYPT);

        // SQL-Statement zum Einfügen eines neuen Benutzers vorbereiten
        $stmt = $this->db->prepare("INSERT INTO users (anrede, fname, lname, email, pword, adresse, plz, ort, username) VALUES (:anrede, :fname, :lname, :email, :pword, :adresse, :plz, :ort, :username)");

        // Parameter an das vorbereitete Statement binden
        $stmt->bindParam(':anrede', $param['anrede']);
        $stmt->bindParam(':fname', $param['fname']);
        $stmt->bindParam(':lname', $param['lname']);
        $stmt->bindParam(':email', $param['email']);
        $stmt->bindParam(':pword', $hashedPassword); // Gehashtes Passwort binden
        $stmt->bindParam(':adresse', $param['adresse']);
        $stmt->bindParam(':plz', $param['plz']);
        $stmt->bindParam(':ort', $param['ort']);
        $stmt->bindParam(':username', $param['username']);

        // SQL-Statement ausführen
        if ($stmt->execute()) {
            // Erfolgsmeldung zurückgeben, falls der Benutzer erfolgreich hinzugefügt wurde
            return json_encode(["status" => "success", "message" => "User successfully added"]);
        } else {
            // Fehlermeldung zurückgeben, falls das Ausführen des Statements fehlschlägt
            return json_encode(["status" => "error", "message" => "Execution failed"]);
        }
    } catch (PDOException $e) {
        // Fehlermeldung zurückgeben, falls ein PDO-Fehler auftritt
        return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
    }
}

    

    // Methode zur Benutzeranmeldung
    public function login($param)
    {
        // SQL-Statement zum Abrufen eines Benutzers mit dem angegebenen Benutzernamen und Passwort vorbereiten
        $stmt = $this->db->prepare("SELECT `id`, `rolle` FROM `users` WHERE `username` = :username AND `pword` = :pword");
        $stmt->bindParam(':username', $param['username']);
        $stmt->bindParam(':pword', $param['pword']);
        $stmt->execute();
        // Benutzerinformationen abrufen
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user){
            // Sitzung starten, falls noch nicht gestartet
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            // Benutzerinformationen in der Sitzung speichern
            $_SESSION['user'] = $user['id'];
            $_SESSION['rolle'] = $user['rolle'];
            // Benutzer-ID zurückgeben
            return $_SESSION['user'];
        } else {
            // Fehlermeldung zurückgeben, falls kein Benutzer gefunden wurde
            return "Kein User vorhanden";
        }
    }

    // Methode zur Benutzerabmeldung
    public function logout(){
        // Sitzung starten, falls noch nicht gestartet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Sitzung zurücksetzen und zerstören
        $_SESSION = array();
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-42000, '/');
        }
        session_destroy();
        // Erfolgsmeldung zurückgeben
        $return = "erfolgreich ausgeloggt";
        return json_encode($return);
    }

    // Methode zum Laden des Warenkorbs aus der Sitzung
    public function loadCart()
    {
        // Sitzung starten, falls noch nicht gestartet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Prüfen, ob der Warenkorb in der Sitzung existiert und ein Array ist, ansonsten initialisieren
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        // Warenkorb zurückgeben
        return $_SESSION['cart'];
    }
    
    // Methode zum Laden eines Produkts nach ID
    public function loadProductByID($param){
        // SQL-Abfrage zum Abrufen des Produkts nach ID ausführen
        $stmt = $this->db->query("SELECT * FROM `products` WHERE `id` = '$param'");
        // Ergebnisse der Abfrage als Array abrufen
        $res = $stmt->fetchAll();
        // Leeres Array zum Speichern der Produktobjekte
        $products = [];
        // Durch die Ergebnisse iterieren und jedes Ergebnis in ein Produktobjekt umwandeln
        foreach ($res as $row){
            $products[] = new Product(
                $row['id'],
                $row['name'],
                $row['price'],
                $row['description'],
                $row['stock'],
                $row['created_at'],
                $row['category']
            );
        }
        // Array der Produktobjekte zurückgeben
        return $products;
    }

    // Methode zum Entfernen eines Produkts aus dem Warenkorb
    public function subtractfromCard($param){
        // Sitzung starten, falls noch nicht gestartet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Prüfen, ob der Warenkorb in der Sitzung existiert und ein Array ist, ansonsten initialisieren
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    
        // Produkt aus dem Warenkorb entfernen
        $index = array_search($param, $_SESSION['cart']);
        if ($index !== false || $index === 0) {
            array_splice($_SESSION['cart'], $index, 1);
        }
    
        // Anzahl der Elemente im Warenkorb zurückgeben
        $elemente_in_Warenkorb = count($_SESSION['cart']);
        return $elemente_in_Warenkorb;
    }

    // Methode zum Suchen von Produkten anhand eines Suchparameters
    public function searchProducts($param){
        // SQL-Statement zum Suchen von Produkten vorbereiten
        $stmt = $this->db->prepare("SELECT * FROM products WHERE name LIKE :param");
        $stmt->execute(array(':param' => '%' . $param . '%'));
        // Ergebnisse der Abfrage als Array abrufen
        $res = $stmt->fetchAll();
        // Leeres Array zum Speichern der Produktobjekte
        $products = [];

        // Durch die Ergebnisse iterieren und jedes Ergebnis in ein Produktobjekt umwandeln
        foreach ($res as $row){
            $products[] = new Product(
                $row['id'],
                $row['name'],
                $row['price'],
                $row['description'],
                $row['stock'],
                $row['created_at'],
                $row['category']
            );
        }
        // Fehlermeldung zurückgeben, falls keine Produkte gefunden wurden
        if (count($products)==0){
            return "keine Produkte gefunden.";
        } else{
            // Array der Produktobjekte zurückgeben
            return $products;
        }
    }

    // Methode zum Abrufen der Benutzerdaten
    public function getUserData(){
        // Sitzung starten, falls noch nicht gestartet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Fehlermeldung zurückgeben, falls der Benutzer nicht eingeloggt ist
        if (!isset($_SESSION['user'])) {
            return "Nicht eingeloggt";
        }
        // Benutzer-ID aus der Sitzung abrufen
        $user = $_SESSION['user'];
        // SQL-Statement zum Abrufen der Benutzerdaten vorbereiten
        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `id` = :userid");
        $stmt->bindParam(':userid', $user);
        $stmt->execute();
        // Benutzerdaten aus der Datenbank abrufen
        $userfromdb = $stmt->fetch(PDO::FETCH_ASSOC);
        if($userfromdb){
            // Benutzerdaten als Objekt zurückgeben
            $userData = new AllUser($userfromdb['username'],$userfromdb['email'],$userfromdb['anrede'],$userfromdb['fname'],$userfromdb['lname'],$userfromdb['adresse'],$userfromdb['plz'],$userfromdb['ort']);
            return $userData;
        } else {
            // Fehlermeldung zurückgeben, falls der Benutzer nicht eingeloggt ist
            return "Nicht eingeloggt";
        }
    }

    public function updateUser($param){
        // Prüfen, ob die Sitzung noch nicht gestartet wurde und starten, falls notwendig
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        // Prüfen, ob ein Benutzer eingeloggt ist
        if (!isset($_SESSION['user'])) {
            return "Nicht eingeloggt";
        }
    
        // ID des eingeloggt Benutzers abrufen
        $userId = $_SESSION['user'];
    
        // Passwort hashen mit bcrypt Algorithmus
        $hashedPassword = password_hash($param['pword'], PASSWORD_BCRYPT);
    
        // SQL-Statement zum Aktualisieren der Benutzerdaten vorbereiten
        $stmt = $this->db->prepare("UPDATE users SET anrede = :anrede, fname = :fname, lname = :lname, email = :email, pword = :pword, adresse = :adresse, plz = :plz, ort = :ort, username = :username WHERE id = :id");
    
        // Parameter an das vorbereitete Statement binden
        $stmt->bindParam(':anrede', $param['anrede']);
        $stmt->bindParam(':fname', $param['fname']);
        $stmt->bindParam(':lname', $param['lname']);
        $stmt->bindParam(':email', $param['email']);
        $stmt->bindParam(':pword', $hashedPassword); // Gehashtes Passwort binden
        $stmt->bindParam(':adresse', $param['adresse']);
        $stmt->bindParam(':plz', $param['plz']);
        $stmt->bindParam(':ort', $param['ort']);
        $stmt->bindParam(':username', $param['username']);
        $stmt->bindParam(':id', $userId);
    
        // SQL-Statement ausführen
        $stmt->execute();
    
        // Erfolgsmeldung zurückgeben
        return "Benutzerdaten aktualisiert";
    }
    
    

    // Methode zum Laden aller Bestellungen eines Benutzers
    public function loadOrders(){
        // Sitzung starten, falls noch nicht gestartet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Fehlermeldung zurückgeben, falls der Benutzer nicht eingeloggt ist
        if (!isset($_SESSION['user'])) {
            return "Nicht eingeloggt";
        }

        // Benutzer-ID aus der Sitzung abrufen
        $userId = $_SESSION['user'];
        // SQL-Statement zum Abrufen der Bestellungen des Benutzers vorbereiten
        $stmt = $this->db->prepare("SELECT * FROM `orders` WHERE `user_id` = :userid");
        $stmt->bindParam(':userid', $userId);
        $stmt->execute();
        // Bestellungen aus der Datenbank abrufen
        $orders = $stmt->fetchAll();
        // Leeres Array zum Speichern der Bestellobjekte
        $order_array = [];
        foreach ($orders as $or){
            $or_id = $or['id'];
            // SQL-Statement zum Abrufen der Bestellartikel für jede Bestellung ausführen
            $state = $this->db->query("SELECT * FROM `order_items` WHERE `order_id` = '$or_id'");
            $res = $state->fetchAll();
            $products = [];
            $quantites = [];
            $prices = [];
            // Durch die Bestellartikel iterieren und die Produktinformationen sammeln
            foreach($res as $re){
                $products[] = $re['product_id'];
                $quantites[] = $re['quantity'];
                $prices[] = $re['price'];
            }

            // Neues Bestellobjekt erstellen und zum Array hinzufügen
            $order_array[] = new Order(
                $or['id'],
                $or['user_id'],
                $or['order_date'],
                $products,
                $quantites,
                $prices
            );
        }

        // Array der Bestellobjekte zurückgeben
        return $order_array;
    }

    // Methode zum Laden einer Bestellung nach ID
    function loadOrderByID($param){
        // SQL-Statement zum Abrufen der Bestellung nach ID vorbereiten
        $stmt = $this->db->prepare("SELECT * FROM `orders` WHERE `id` = :id");
        $stmt->bindParam(':id', $param);
        $stmt->execute();
        // Bestellung aus der Datenbank abrufen
        $orders = $stmt->fetchAll();
        // Leeres Array zum Speichern der Bestellobjekte
        $order_array = [];
        foreach ($orders as $or){
            $or_id = $or['id'];
            // SQL-Statement zum Abrufen der Bestellartikel für die Bestellung ausführen
            $state = $this->db->query("SELECT * FROM `order_items` WHERE `order_id` = '$or_id'");
            $res = $state->fetchAll();
            $products = [];
            $quantites = [];
            $prices = [];
            // Durch die Bestellartikel iterieren und die Produktinformationen sammeln
            foreach($res as $re){
                $products[] = $re['product_id'];
                $quantites[] = $re['quantity'];
                $prices[] = $re['price'];
            }

            // Neues Bestellobjekt erstellen und zum Array hinzufügen
            $order_array = new Order(
                $or['id'],
                $or['user_id'],
                $or['order_date'],
                $products,
                $quantites,
                $prices
            );
        }

        // Array der Bestellobjekte zurückgeben
        return $order_array;
    }

    // Methode zum Bearbeiten eines Produkts
    function editProduct($param){
        // SQL-Statement zum Aktualisieren eines Produkts vorbereiten
        $stmt = $this->db->prepare("UPDATE products SET name = :name, price = :preis WHERE id = :id;");
        $stmt->bindParam(':id', $param['triggerElement']);
        $stmt->bindParam(':name', $param['newName']);
        $stmt->bindParam(':preis', $param['newPrice']);
        $stmt->execute();
        // Erfolgsmeldung zurückgeben
        return "Daten wurden in der Datenbank geändert.";
    }

    // Methode zum Löschen eines Produkts
    function deleteProduct($param) {
        // SQL-Statement zum Löschen eines Produkts vorbereiten
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id;");
        $stmt->bindParam(':id', $param);
        $stmt->execute();
        // Erfolgsmeldung zurückgeben
        return "Produkt wurde aus der Datenbank gelöscht.";
    }

    // Methode zum Hinzufügen eines neuen Produkts
    function addProduct($param){
        // SQL-Statement zum Einfügen eines neuen Produkts vorbereiten
        $stmt = $this->db->prepare("INSERT INTO products (name, description, price, category) VALUES (:name, :description, :price, :category);");
        $stmt->bindParam(':name', $param['adName']);
        $stmt->bindParam(':description', $param['adDesc']);
        $stmt->bindParam(':price', $param['adPrice']);
        $stmt->bindParam(':category', $param['adKat']);
        $stmt->execute();
        // Erfolgsmeldung zurückgeben
        return "Datensatz wurde in der Datenbank hinzugefügt.";
    }

    // Methode zum Hinzufügen des Warenkorbs zu einer Bestellung
    public function addCartToOrder($param){
        // Sitzung starten, falls noch nicht gestartet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Fehlermeldung zurückgeben, falls der Benutzer nicht eingeloggt ist
        if (!isset($_SESSION['user'])) {
            return "Nicht eingeloggt";
        }
        // Warenkorb aus der Sitzung abrufen
        $cart = $_SESSION['cart'];
        // Durch die Elemente im Warenkorb iterieren und jedes Element zur Bestellung hinzufügen
        foreach ($cart as $element) {
            $stmt = $this->db->prepare("INSERT INTO `order_items`(`order_id`, `product_id`, `quantity`) VALUES (:par,:ele,'1');");
            $stmt->bindParam(':par', $param);
            $stmt->bindParam(':ele', $element);
            $stmt->execute();
        }
        // Erfolgsmeldung zurückgeben
        return "Produkte wurden erfolgreich hinzugefügt.";
    }

    // Methode zum Erstellen einer neuen Bestellung
    public function order(){
        // Sitzung starten, falls noch nicht gestartet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Fehlermeldung zurückgeben, falls der Benutzer nicht eingeloggt ist
        if (!isset($_SESSION['user'])) {
            return "Nicht eingeloggt";
        }

        // Benutzer-ID aus der Sitzung abrufen
        $us = $_SESSION['user'];
        // SQL-Statement zum Einfügen einer neuen Bestellung vorbereiten
        $stmt = $this->db->prepare("INSERT INTO orders (user_id) VALUES (:us);");
        $stmt->bindParam(':us', $us);
        $stmt->execute();

        // ID der zuletzt eingefügten Bestellung abrufen und zurückgeben
        $st = $this->db->query("SELECT id FROM `orders` ORDER BY id DESC LIMIT 1;");
        $or = $st->fetch(PDO::FETCH_ASSOC);
        return $or;
    }
}
