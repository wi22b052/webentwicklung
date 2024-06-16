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

class cart {
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

class user {
    public $id;
    public $username;
    public $email;
    public $pword;
    public $created_at;
    public $anrede;
    public $fname;
    public $lname;
    public $adresse;
    public $plz;
    public $ort;

    
    function __construct($id, $username, $email, $pword, $created_at, $anrede, $fname, $lname, $adresse, $plz, $ort){
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->pword = $pword;
        $this->created_at = $created_at;
        $this->anrede = $anrede;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->adresse = $adresse;
        $this->plz = $plz;
        $this->ort = $ort;
    }

}
