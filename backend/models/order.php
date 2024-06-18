<?php
// Definition der Klasse Order
class Order {
    // Öffentliche Eigenschaften der Klasse Order
    public $id;
    public $user_id;
    public $order_date;
    public $products;
    public $quantities;
    public $prices;
    
    // Konstruktor der Klasse, der beim Erstellen eines neuen Order-Objekts aufgerufen wird
    function __construct($id, $user_id, $order_date, $products, $quantities, $prices) {
        // Initialisierung der Eigenschaften mit den übergebenen Werten
        $this->id = $id;
        $this->user_id = $user_id;
        $this->order_date = $order_date;
        $this->products = $products;
        $this->quantities = $quantities;
        $this->prices = $prices;
    }
}
