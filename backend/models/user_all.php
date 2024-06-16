<?php
class AllUser {
    public $username;
    public $email;
    public $anrede;
    public $fname;
    public $lname;
    public $adresse;
    public $plz;
    public $ort;
    
    function __construct($username, $email, $anrede, $fname, $lname, $adresse, $plz, $ort){
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

