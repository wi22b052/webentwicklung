<?php
// Definition der Klasse Product
class Product {
    // Öffentliche Eigenschaften der Klasse Product
    public $id;
    public $user_id;
    public $product_id;
    public $quantity;
    
    // Konstruktor der Klasse, der beim Erstellen eines neuen Product-Objekts aufgerufen wird
    function __construct($id, $user_id, $product_id, $quantity){
        // Initialisierung der Eigenschaften mit den übergebenen Werten
        $this->id = $id;
        $this->user_id = $user_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }
}
