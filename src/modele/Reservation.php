<?php


class Reservation
{
    private $idReservation;
    private $statut;
    private $qte_plein_tarif;
    private $qte_etudiant;
    private $qte_senior;

    /**
     * @param $idReservation
     * @param $statut
     * @param $qte_plein_tarif
     * @param $qte_etudiant
     * @param $qte_senior
     */

    public function __construct($idReservation, $statut, $qte_plein_tarif, $qte_etudiant, $qte_senior)
    {
        $this->idReservation = $idReservation;
        $this->statut = $statut;
        $this->qte_plein_tarif = $qte_plein_tarif;
        $this->qte_etudiant = $qte_etudiant;
        $this->qte_senior = $qte_senior;
    }

    /**
     * @return mixed
     */
    public function getIdReservation()
    {
        return $this->idReservation;
    }

    /**
     * @param mixed $idReservation
     */
    public function setIdReservation($idReservation)
    {
        $this->idReservation = $idReservation;
    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param mixed $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return mixed
     */
    public function getQtePleinTarif()
    {
        return $this->qte_plein_tarif;
    }

    /**
     * @param mixed $qte_plein_tarif
     */
    public function setQtePleinTarif($qte_plein_tarif)
    {
        $this->qte_plein_tarif = $qte_plein_tarif;
    }

    /**
     * @return mixed
     */
    public function getQteEtudiant()
    {
        return $this->qte_etudiant;
    }

    /**
     * @param mixed $qte_etudiant
     */
    public function setQteEtudiant($qte_etudiant)
    {
        $this->qte_etudiant = $qte_etudiant;
    }

    /**
     * @return mixed
     */
    public function getQteSenior()
    {
        return $this->qte_senior;
    }

    /**
     * @param mixed $qte_senior
     */
    public function setQteSenior($qte_senior)
    {
        $this->qte_senior = $qte_senior;
    }
}