<?php
class ReservationRepository
{
    private $connexionBdd;
    public function __construct(){
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }

    public function getReservation($id_reservation){
        $sql = "SELECT * FROM reservation WHERE id_reservation = :id_reservation";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_reservation', $id_reservation);
        $req->execute();
        $result = $req->fetch();
        $reservation = new Reservation($result["id_reservation"], $result["statut"], $result["qte_plein_tarif"], $result["qte_etudiant"], $result["qte_senior"]);
        return $reservation;
    }

    public function getAllReservations(){
        $sql = "SELECT * FROM reservation";
        $req = $this->connexionBdd->prepare($sql);
        $req->execute();
        $results = $req->fetchAll();
        $tabReservations = array();
        foreach($results as $result){
            $reservation = new Reservation($result["id_reservation"], $result["statut"], $result["qte_plein_tarif"], $result["qte_etudiant"], $result["qte_senior"]);
        $tabReservations[] = $reservation;
        }
        return $tabReservations;
    }

    public function ajouterReservation(Reservation $reservation){
        $sql = "INSERT INTO reservation VALUES :id_reservation, :statut, :qte_plein_tarif, :qte_etudiant, :qte_senior";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_reservation', $reservation->getIdReservation());
        $req->bindValue(':statut', $reservation->getStatut());
        $req->bindValue(':qte_plein_tarif', $reservation->getQtePleinTarif());
        $req->bindValue(':qte_etudiant', $reservation->getQteEtudiant());
        $req->bindValue(':qte_senior', $reservation->getQteSenior());
        $req->execute();
    }
    public function supprimerReservation(Reservation $reservation){
        $sql = "DELETE FROM reservation WHERE id_reservation = :id_reservation";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':idreservation', $reservation->getIdReservation() );
        $req->execute();
    }

    public function modifierReservation( Reservation $reservation){
        $sql = "UPDATE reservation SET statut = :statut , qte_plein_tarif = :qte_plein_tarif , qte_etudiant = :qte_etudiant , qte_senior = :qte_senior  WHERE id_reservation = :id_reservation";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':statut', $reservation->getStatut());
        $req->bindValue(':id_reservation', $reservation->getIdReservation());
        $req->bindValue(':qte_etudiant', $reservation->getQteEtudiant());
        $req->bindValue(':qte_senior', $reservation->getQteSenior());
        $req->bindValue(':qte_plein_tarif', $reservation->getQtePleinTarif());
        return $req->execute();
    }










}