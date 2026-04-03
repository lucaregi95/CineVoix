<?php

class Film
{
    private $id_film;
    private $nom;
    private $description;
    private $duree;
    private $affiche;
    private $genre;
    private $age_min;
    private $realisateur;
    private $date_sortie;
    private $bande_annonce;

    /**
     * @param $id_film
     * @param $nom
     * @param $description
     * @param $duree
     * @param $affiche
     * @param $genre
     * @param $age_min
     * @param $realisateur
     * @param $date_sortie
     * @param $bande_annonce
     */
    public function __construct($id_film, $nom, $description, $duree, $affiche, $genre, $age_min, $realisateur, $date_sortie, $bande_annonce)
    {
        $this->id_film = $id_film;
        $this->nom = $nom;
        $this->description = $description;
        $this->duree = $duree;
        $this->affiche = $affiche;
        $this->genre = $genre;
        $this->age_min = $age_min;
        $this->realisateur = $realisateur;
        $this->date_sortie = $date_sortie;
        $this->bande_annonce = $bande_annonce;
    }

    /**
     * @return mixed
     */
    public function getBandeAnnonce()
    {
        return $this->bande_annonce;
    }

    /**
     * @param mixed $bande_annonce
     */
    public function setBandeAnnonce($bande_annonce)
    {
        $this->bande_annonce = $bande_annonce;
    }

    /**
     * @return mixed
     */
    public function getDateSortie()
    {
        return $this->date_sortie;
    }

    /**
     * @param mixed $date_sortie
     */
    public function setDateSortie($date_sortie)
    {
        $this->date_sortie = $date_sortie;
    }

    /**
     * @return mixed
     */
    public function getRealisateur()
    {
        return $this->realisateur;
    }

    /**
     * @param mixed $realisateur
     */
    public function setRealisateur($realisateur)
    {
        $this->realisateur = $realisateur;
    }

    /**
     * @return mixed
     */
    public function getAgeMin()
    {
        return $this->age_min;
    }

    /**
     * @param mixed $age_min
     */
    public function setAgeMin($age_min)
    {
        $this->age_min = $age_min;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    /**
     * @return mixed
     */
    public function getAffiche()
    {
        return $this->affiche;
    }

    /**
     * @param mixed $affiche
     */
    public function setAffiche($affiche)
    {
        $this->affiche = $affiche;
    }

    /**
     * @return mixed
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param mixed $duree
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
    public function getIdFilm()
    {
        return $this->id_film;
    }

    /**
     * @param mixed $id_film
     */
    public function setIdFilm($id_film)
    {
        $this->id_film = $id_film;
    }


}