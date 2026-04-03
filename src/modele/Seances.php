<?php
class Seances
{
    private $id_seance;
    private $date_seance;
    private $ref_film;
    private $ref_salle;

    /**
     * @param $id_seance
     * @param $date_seance
     * @param $ref_film
     * @param $ref_salle
     */
    public function __construct($id_seance, $date_seance, $ref_film, $ref_salle)
    {
        $this->id_seance = $id_seance;
        $this->date_seance = $date_seance;
        $this->ref_film = $ref_film;
        $this->ref_salle = $ref_salle;
    }

    /**
     * @return mixed
     */
    public function getIdSeance()
    {
        return $this->id_seance;
    }

    /**
     * @param mixed $id_seance
     */
    public function setIdSeance($id_seance)
    {
        $this->id_seance = $id_seance;
    }

    /**
     * @return mixed
     */
    public function getDateSeance()
    {
        return $this->date_seance;
    }

    /**
     * @param mixed $date_seance
     */
    public function setDateSeance($date_seance)
    {
        $this->date_seance = $date_seance;
    }

    /**
     * @return mixed
     */
    public function getRefFilm()
    {
        return $this->ref_film;
    }

    /**
     * @param mixed $ref_film
     */
    public function setRefFilm($ref_film)
    {
        $this->ref_film = $ref_film;
    }

    /**
     * @return mixed
     */
    public function getRefSalle()
    {
        return $this->ref_salle;
    }

    /**
     * @param mixed $ref_salle
     */
    public function setRefSalle($ref_salle)
    {
        $this->ref_salle = $ref_salle;
    }


}
