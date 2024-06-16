<?php
class Order {
    public $id;
    public $user_id;
    public $order_date;
    public $products;
    public $quantities;
    public $prices;
    
    function __construct($id, $user_id, $order_date,$products,$quantities,$prices) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->order_date = $order_date;
        $this->products = $products;
        $this->quantities = $quantities;
        $this->prices = $prices;
    }
}
