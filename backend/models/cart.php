<?php
class Product {
    public $id;
    public $user_id;
    public $product_id;
    public $quantity;
    
    function __construct($id, $user_id, $product_id, $quantity){
        $this->id = $id;
        $this->user_id = $user_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }
}
