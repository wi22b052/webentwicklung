<?php
// Definition der Klasse User
class User {
    // Öffentliche Eigenschaften der Klasse User
    public $id;
    public $username;
    public $password;
    public $email;
    
    // Konstruktor der Klasse, der beim Erstellen eines neuen User-Objekts aufgerufen wird
    function __construct($id, $username, $password, $email){
        // Initialisierung der Eigenschaften mit den übergebenen Werten
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }
}
