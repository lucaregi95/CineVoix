<?php
class Bdd {
    private $connexionBdd;
    private $identifiant = "root";
    private $motDePasse ="";
    private $nomBdd = "cinevoix";
    private $host = "localhost";

    public function __construct()
    {
        $this->connexionBdd = new PDO("mysql:host=".$this->host.";dbname=".$this->nomBdd, $this->identifiant, $this->motDePasse);
    }

    public function getConnexionBdd(){
        return $this->connexionBdd;
    }


}