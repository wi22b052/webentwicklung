<?php
include("./models/product.class.php");
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
                ini_set('session.cookie_lifetime', 0);
                session_start();
                $_SESSION['user'] = $user['id'];
                $_SESSION['rolle'] = $user['rolle'];
                return $_SESSION['rolle'];
            } else {
                return "Kein User vorhanden";
            }
            

    }

    public function logout(){
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



}
