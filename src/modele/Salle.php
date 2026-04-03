<?php

class Salle{

    private $id_salle;
    private $code;
    private $nom;
    private $capacite;
    private $etat;

    /**
     * @param $etat
     * @param $capacite
     * @param $nom
     * @param $code
     * @param $id_salle
     */
    public function __construct($etat, $capacite, $nom, $code, $id_salle)
    {
        $this->etat = $etat;
        $this->capacite = $capacite;
        $this->nom = $nom;
        $this->code = $code;
        $this->id_salle = $id_salle;
    }

    /**
     * @return mixed
     */
    public function getIdSalle()
    {
        return $this->id_salle;
    }

    /**
     * @param mixed $id_salle
     */
    public function setIdSalle($id_salle)
    {
        $this->id_salle = $id_salle;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getCapacite()
    {
        return $this->capacite;
    }

    /**
     * @param mixed $capacite
     */
    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }








}