<?php

class Acteurs {


    private $id_acteur;
    private $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $dateNaissance;
    private $telephone;
    private $rue;
    private $ville;
    private $cp;
    private $role;
    private $etat;
    private $date_creation;

    /**
     * @param $role
     * @param $nom
     * @param $prenom
     * @param $email
     * @param $mdp
     * @param $dateNaissance
     * @param $telephone
     * @param $rue
     * @param $ville
     * @param $cp
     * @param $etat
     */
    public function __construct($id_acteur, $nom, $prenom, $email, $mdp, $dateNaissance, $telephone, $rue, $ville, $cp, $role, $etat) {
        $this->id_acteur = $id_acteur;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mdp = $mdp;
        $this->dateNaissance = $dateNaissance;
        $this->telephone = $telephone;
        $this->rue = $rue;
        $this->ville = $ville;
        $this->cp = $cp;
        $this->etat = $etat;
        $this->role = $role;

        $date = new DateTimeImmutable();
        $date = $date->format('Y\-m\-d');
        $this->date_creation = $date;


    }

    /**
     * @return mixed
     */
    public function getIdActeur()
    {
        return $this->id_acteur;
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
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * @param mixed $mdp
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    /**
     * @param mixed $mdp
     */


    /**
     * @return mixed
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param mixed $dateNaissance
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * @param mixed $rue
     */
    public function setRue($rue)
    {
        $this->rue = $rue;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return mixed
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @param mixed $cp
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param int $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return int
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    /**
     * @param int $date_creation
     */
    public function setDateCreation($date_creation)
    {
        $this->date_creation = $date_creation;
    }











}