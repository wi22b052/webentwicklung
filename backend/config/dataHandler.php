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
                $row['description'],
                $row['price'],
                $row['stock'],
                $row['created_at'],
            );
        }
        return $products;
    }

}
