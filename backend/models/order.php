<?php
class Product {
    public $id;
    public $product;
    public $amount;
    public $date;
    
    function __construct($id, $product, $amount, $date){
        $this->id = $id;
        $this->product = $product;
        $this->amount = $amount;
        $this->date = $date;
    }
}
