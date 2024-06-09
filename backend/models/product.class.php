<?php
class Product {
    public $id;
    public $name;
    public $price;
    public $description;
    public $stock;
    public $created_at;
    
    function __construct($id, $name, $price, $description, $stock, $created_at){
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->stock = $stock;
        $this->created_at = $created_at;
    }
}
