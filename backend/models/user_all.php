<?php
// Definition der Klasse AllUser
class AllUser {
    // Öffentliche Eigenschaften der Klasse AllUser
    public $username;
    public $email;
    public $anrede;
    public $fname;
    public $lname;
    public $adresse;
    public $plz;
    public $ort;
    
    // Konstruktor der Klasse, der beim Erstellen eines neuen AllUser-Objekts aufgerufen wird
    function __construct($username, $email, $anrede, $fname, $lname, $adresse, $plz, $ort){
        // Initialisierung der Eigenschaften mit den übergebenen Werten
        $this->username = $username;
        $this->email = $email;
        $this->anrede = $anrede;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->adresse = $adresse;
        $this->plz = $plz;
        $this->ort = $ort;
    }
}
