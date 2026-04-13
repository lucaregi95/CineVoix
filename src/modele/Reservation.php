<?php

class Reservation
{
    private $idReservation;
    private $statut;
    private $qte_plein_tarif;
    private $qte_etudiant;
    private $qte_senior;
    private $moyen_paiement;
    private $ref_seance;
    private $ref_code;
    private $ref_acteur;

    /**
     * @param $idReservation
     * @param $statut
     * @param $qte_plein_tarif
     * @param $qte_etudiant
     * @param $qte_senior
     * @param $moyen_paiement
     * @param $ref_seance
     * @param $ref_code
     * @param $ref_acteur
     */

    public function __construct($idReservation, $statut, $qte_plein_tarif, $qte_etudiant, $qte_senior, $moyen_paiement, $ref_seance, $ref_code, $ref_acteur)
    {
        $this->idReservation = $idReservation;
        $this->statut = $statut;
        $this->qte_plein_tarif = $qte_plein_tarif;
        $this->qte_etudiant = $qte_etudiant;
        $this->qte_senior = $qte_senior;
        $this->moyen_paiement = $moyen_paiement;
        $this->ref_seance = $ref_seance;
        $this->ref_code = $ref_code;
        $this->ref_acteur = $ref_acteur;
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

    /**
     * @return mixed
     */
    public function getMoyenPaiement()
    {
        return $this->moyen_paiement;
    }

    /**
     * @param mixed $moyen_paiement
     */
    public function setMoyenPaiement($moyen_paiement)
    {
        $this->moyen_paiement = $moyen_paiement;
    }

    /**
     * @return mixed
     */
    public function getRefSeance()
    {
        return $this->ref_seance;
    }

    /**
     * @param mixed $ref_seance
     */
    public function setRefSeance($ref_seance)
    {
        $this->ref_seance = $ref_seance;
    }

    /**
     * @return mixed
     */
    public function getRefCode()
    {
        return $this->ref_code;
    }

    /**
     * @param mixed $ref_code
     */
    public function setRefCode($ref_code)
    {
        $this->ref_code = $ref_code;
    }

    /**
     * @return mixed
     */
    public function getRefActeur()
    {
        return $this->ref_acteur;
    }

    /**
     * @param mixed $ref_acteur
     */
    public function setRefActeur($ref_acteur)
    {
        $this->ref_acteur = $ref_acteur;
    }

}