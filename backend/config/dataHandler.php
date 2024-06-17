<?php
include("./models/product.class.php");
include("./models/user_all.php");
include("./models/order.php");
class DataHandler
{

    private $db;

    public function __construct()
    {
        $this->db = $this->connectDB();
    }

    private function connectDB()
    {
        try {
            $host = "localhost";
            $dbname = "webshop";
            $username = "username";
            $password = "password"; 
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

            return new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            exit;
        }
    }

   public function queryProducts()
    {
        $stmt = $this->db->query('SELECT * FROM products');
        $res = $stmt->fetchAll();
        $products = [];

        foreach ($res as $row){
            $products[] = new Product(
                $row['id'],
                $row['name'],
                $row['price'],
                $row['description'],
                $row['stock'],
                $row['created_at'],
                $row['category'],
            );
        }
        return $products;
    }

    public function queryProductsByCategory($param)
    {
        $stmt = $this->db->query("SELECT * FROM `products` WHERE `category` = '$param'");
        $res = $stmt->fetchAll();
        $products = [];

        foreach ($res as $row){
            $products[] = new Product(
                $row['id'],
                $row['name'],
                $row['price'],
                $row['description'],
                $row['stock'],
                $row['created_at'],
                $row['category'],
            );
        }
        return $products;
    }

    public function addtoCart($param)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $_SESSION['cart'][] = $param;
        $elemente_in_Warenkorb = count($_SESSION['cart']);
        return $elemente_in_Warenkorb;
    }

    public function addUser($param)
    {
        try {
        $stmt = $this->db->prepare("INSERT INTO users (anrede, fname, lname, email, pword, adresse, plz, ort, username) VALUES (:anrede, :fname, :lname, :email, :pword, :adresse, :plz, :ort, :username)");

        $stmt->bindParam(':anrede', $param['anrede']);
        $stmt->bindParam(':fname', $param['fname']);
        $stmt->bindParam(':lname', $param['lname']);
        $stmt->bindParam(':email', $param['email']);
        $stmt->bindParam(':pword', $param['pword']);
        $stmt->bindParam(':adresse', $param['adresse']);
        $stmt->bindParam(':plz', $param['plz']);
        $stmt->bindParam(':ort', $param['ort']);
        $stmt->bindParam(':username', $param['username']);

        if ($stmt->execute()) {
            return json_encode(["status" => "success", "message" => "User successfully added"]);
        } else {
            return json_encode(["status" => "error", "message" => "Execution failed"]);
        }
    } catch (PDOException $e) {
        return json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
    }
}

    public function login($param)
    {
            $stmt = $this->db->prepare("SELECT `id`, `rolle` FROM `users` WHERE `username` = :username AND `pword` = :pword");
            $stmt-> bindParam(':username', $param['username']);
            $stmt-> bindParam(':pword', $param['pword']);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user){
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user'] = $user['id'];
                $_SESSION['rolle'] = $user['rolle'];
                return $_SESSION['user'];
            } else {
                return "Kein User vorhanden";
            }
            

    }

    public function logout(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = array();
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-42000, '/');
        }
        session_destroy();
        $return = "erfolgreich ausgeloggt";
        return json_encode($return);
    }

    public function loadCart()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        return $_SESSION['cart'];
        }
    
    public function loadProductByID($param){
        $stmt = $this->db->query("SELECT * FROM `products` WHERE `id` = '$param'");
        $res = $stmt->fetchAll();
        $products = [];
        foreach ($res as $row){
            $products[] = new Product(
                $row['id'],
                $row['name'],
                $row['price'],
                $row['description'],
                $row['stock'],
                $row['created_at'],
                $row['category'],
            );
        }
        return $products;

    }

    public function subtractfromCard($param){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    
        $index = array_search($param, $_SESSION['cart']);
        if ($index !== false || $index === 0) {
            array_splice($_SESSION['cart'], $index, 1);
        }
    
        $elemente_in_Warenkorb = count($_SESSION['cart']);
        return $elemente_in_Warenkorb;
    }

    public function searchProducts($param){
        $stmt = $this->db->prepare("SELECT * FROM products WHERE name LIKE :param");
        $stmt->execute(array(':param' => '%' . $param . '%'));
        $res = $stmt->fetchAll();
        $products = [];

        foreach ($res as $row){
            $products[] = new Product(
                $row['id'],
                $row['name'],
                $row['price'],
                $row['description'],
                $row['stock'],
                $row['created_at'],
                $row['category'],
            );
        }
        if (count($products)==0){
            return "keine Produkte gefunden.";
        } else{
            return $products;
        }
        
    }

    public function getUserData(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            return "Nicht eingeloggt";
        }
        $user = $_SESSION['user'];
        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `id` = :userid");
        $stmt-> bindParam(':userid', $user);
        $stmt->execute();
        $userfromdb = $stmt->fetch(PDO::FETCH_ASSOC);
            if($userfromdb){
               $userData = new AllUser($userfromdb['username'],$userfromdb['email'],$userfromdb['anrede'],$userfromdb['fname'],$userfromdb['lname'],$userfromdb['adresse'],$userfromdb['plz'],$userfromdb['ort']);
               return $userData;
            } else {
                return "Nicht eingeloggt";
            }
    }

    public function updateUser($param){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        if (!isset($_SESSION['user'])) {
            return "Nicht eingeloggt";
        }
    
        $userId = $_SESSION['user'];
    
        $stmt = $this->db->prepare("UPDATE users SET anrede = :anrede, fname = :fname, lname = :lname, email = :email, pword = :pword, adresse = :adresse, plz = :plz, ort = :ort, username = :username WHERE id = :id");

        $stmt->bindParam(':anrede', $param['anrede']);
        $stmt->bindParam(':fname', $param['fname']);
        $stmt->bindParam(':lname', $param['lname']);
        $stmt->bindParam(':email', $param['email']);
        $stmt->bindParam(':pword', $param['pword']);
        $stmt->bindParam(':adresse', $param['adresse']);
        $stmt->bindParam(':plz', $param['plz']);
        $stmt->bindParam(':ort', $param['ort']);
        $stmt->bindParam(':username', $param['username']);
        $stmt->bindParam(':id', $userId);

        $stmt->execute();

        return "Benutzerdaten aktualisiert";
    }


    public function loadOrders(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            return "Nicht eingeloggt";
        }

        $userId = $_SESSION['user'];
        $stmt = $this->db->prepare("SELECT * FROM `orders` WHERE `user_id` = :userid");
        $stmt-> bindParam(':userid', $userId);
        $stmt->execute();
        $orders = $stmt->fetchAll();
        $order_array = [];
        foreach ($orders as $or){
            $or_id = $or['id'];
            $state = $this->db->query("SELECT * FROM `order_items` WHERE `order_id` = '$or_id'");
            $res = $state->fetchAll();
            $products = [];
            $quantites = [];
            $prices = [];
            foreach($res as $re){
                $products[] = $re['product_id'];
                $quantites[] = $re['quantity'];
                $prices[] = $re['price'];
            }

            $order_array[] = new Order(
                $or['id'],
                $or['user_id'],
                $or['order_date'],
                $products,
                $quantites,
                $prices
            );
        }

        return $order_array;
    }
    
    function loadOrderByID($param){
        $stmt = $this->db->prepare("SELECT * FROM `orders` WHERE `id` = :id");
        $stmt-> bindParam(':id', $param);
        $stmt->execute();
        $orders = $stmt->fetchAll();
        $order_array = [];
        foreach ($orders as $or){
            $or_id = $or['id'];
            $state = $this->db->query("SELECT * FROM `order_items` WHERE `order_id` = '$or_id'");
            $res = $state->fetchAll();
            $products = [];
            $quantites = [];
            $prices = [];
            foreach($res as $re){
                $products[] = $re['product_id'];
                $quantites[] = $re['quantity'];
                $prices[] = $re['price'];
            }

            $order_array = new Order(
                $or['id'],
                $or['user_id'],
                $or['order_date'],
                $products,
                $quantites,
                $prices
            );
        }

        return $order_array;
    }

    function editProduct($param){
        $stmt = $this->db->prepare("UPDATE products SET name = :name, price = :preis WHERE id = :id;");
        $stmt-> bindParam(':id', $param['triggerElement']);
        $stmt-> bindParam(':name', $param['newName']);
        $stmt-> bindParam(':preis', $param['newPrice']);
        $stmt->execute();
        return "Daten wurden in der Datenbank geändert.";
    }

    function deleteProduct($param) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id;");
        $stmt->bindParam(':id', $param);
        $stmt->execute();
        return "Produkt wurde aus der Datenbank gelöscht.";
    }

    function addProduct($param){
        $stmt = $this->db->prepare("INSERT INTO products (name, description, price, category) VALUES (:name, :description, :price, :category);");
        $stmt->bindParam(':name', $param['adName']);
        $stmt->bindParam(':description', $param['adDesc']);
        $stmt->bindParam(':price', $param['adPrice']);
        $stmt->bindParam(':category', $param['adKat']);
        $stmt->execute();
        return "Datensatz wurde in der Datenbank hinzugefügt.";
    }

    public function addCartToOrder($param){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            return "Nicht eingeloggt";
        }
        $cart = $_SESSION['cart'];
        foreach ($cart as $element) {
            $stmt = $this->db->prepare("INSERT INTO `order_items`(`order_id`, `product_id`, `quantity`) VALUES (:par,:ele,'1');");
            $stmt->bindParam(':par', $param);
            $stmt->bindParam(':ele', $element);
            $stmt->execute();
        }
        return "Produkte wurden erfolgreich hinzugefügt.";
    }

    public function order(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            return "Nicht eingeloggt";
        }

        
        $us = $_SESSION['user'];
        $stmt = $this->db->prepare("INSERT INTO orders (user_id) VALUES (:us);");
        $stmt->bindParam(':us', $us);
        $stmt->execute();

        $st = $this->db->query("SELECT id FROM `orders` ORDER BY id DESC LIMIT 1;");
        $or = $st->fetch(PDO::FETCH_ASSOC);
        return $or;
        
    }


    


}
