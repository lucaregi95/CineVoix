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
        $reservation = new Reservation($result["id_reservation"], $result["statut"], $result["qte_plein_tarif"], $result["qte_etudiant"], $result["qte_senior"], $result["moyen_paiement"], $result["ref_seance"],$result["ref_code"], $result["ref_acteur"]);
        return $reservation;
    }

    public function getAllReservations(){
        $sql = "SELECT * FROM reservation";
        $req = $this->connexionBdd->prepare($sql);
        $req->execute();
        $results = $req->fetchAll();
        $tabReservations = array();
        foreach($results as $result){
            $reservation = new Reservation($result["id_reservation"], $result["statut"], $result["qte_plein_tarif"], $result["qte_etudiant"], $result["qte_senior"], $result["moyen_paiement"], $result["ref_seance"],$result["ref_code"], $result["ref_acteur"]);
        $tabReservations[] = $reservation;
        }
        return $tabReservations;
    }

    public function ajouterReservation(Reservation $reservation){
        $sql = "INSERT INTO reservation VALUES (:id_reservation, :statut, :qte_plein_tarif, :qte_etudiant, :qte_senior, :moyen_paiement, :ref_seance, :ref_code, :ref_acteur)";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_reservation', $reservation->getIdReservation());
        $req->bindValue(':statut', $reservation->getStatut());
        $req->bindValue(':qte_plein_tarif', $reservation->getQtePleinTarif());
        $req->bindValue(':qte_etudiant', $reservation->getQteEtudiant());
        $req->bindValue(':qte_senior', $reservation->getQteSenior());
        $req->bindValue(':moyen_paiement', $reservation->getMoyenPaiement());
        $req->bindValue(":ref_seance", $reservation->getRefSeance());
        $req->bindValue(":ref_code", $reservation->getRefCode());
        $req->bindValue(":ref_acteur", $reservation->getRefActeur());
        $req->execute();
    }
    public function supprimerReservation(Reservation $reservation){
        $sql = "DELETE FROM reservation WHERE id_reservation = :id_reservation";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':idreservation', $reservation->getIdReservation() );
        $req->execute();
    }

    public function modifierReservation( Reservation $reservation){
        $sql = "UPDATE reservation SET statut = :statut , qte_plein_tarif = :qte_plein_tarif , qte_etudiant = :qte_etudiant , qte_senior = :qte_senior, moyen_paiement=:moyen_paiement  WHERE id_reservation = :id_reservation";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':statut', $reservation->getStatut());
        $req->bindValue(':id_reservation', $reservation->getIdReservation());
        $req->bindValue(':qte_etudiant', $reservation->getQteEtudiant());
        $req->bindValue(':qte_senior', $reservation->getQteSenior());
        $req->bindValue(':qte_plein_tarif', $reservation->getQtePleinTarif());
        $req->bindValue(':moyen_paiement', $reservation->getMoyenPaiement());
        $req->bindValue(":ref_seance", $reservation->getRefSeance());
        $req->bindValue(":ref_code", $reservation->getRefCode());
        $req->bindValue(":ref_acteur", $reservation->getRefActeur());
        return $req->execute();
    }










}