<?php
class Product {
    public $id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $created_at;
    public $category;
    
    function __construct($id, $name, $price, $description, $stock, $created_at, $category){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
        $this->created_at = $created_at;
        $this->category = $category;
    }
}
