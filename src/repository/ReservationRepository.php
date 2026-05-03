<?php
class ReservationRepository
{
    private $connexionBdd;

    public function __construct()
    {
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }

    public function getReservation($id_reservation)
    {
        $sql = "SELECT * FROM reservation WHERE id_reservation = :id_reservation";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_reservation', $id_reservation, PDO::PARAM_INT);
        $req->execute();

        $result = $req->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new Reservation(
            $result["id_reservation"],
            $result["statut"],
            $result["qte_plein_tarif"],
            $result["qte_etudiant"],
            $result["qte_senior"],
            $result["moyen_paiement"],
            $result["ref_seance"],
            $result["ref_code"],
            $result["ref_acteur"]
        );
    }

    public function getAllReservations()
    {
        $sql = "SELECT * FROM reservation";
        $req = $this->connexionBdd->prepare($sql);
        $req->execute();

        $results = $req->fetchAll(PDO::FETCH_ASSOC);
        $tabReservations = [];

        foreach ($results as $result) {
            $tabReservations[] = new Reservation(
                $result["id_reservation"],
                $result["statut"],
                $result["qte_plein_tarif"],
                $result["qte_etudiant"],
                $result["qte_senior"],
                $result["moyen_paiement"],
                $result["ref_seance"],
                $result["ref_code"],
                $result["ref_acteur"]
            );
        }

        return $tabReservations;
    }

    public function ajouterReservation(Reservation $reservation)
    {
        $sql = "INSERT INTO reservation 
        (statut, qte_plein_tarif, qte_etudiant, qte_senior, moyen_paiement, ref_seance, ref_code, ref_acteur)
        VALUES 
        (:statut, :qte_plein_tarif, :qte_etudiant, :qte_senior, :moyen_paiement, :ref_seance, :ref_code, :ref_acteur)";

        $req = $this->connexionBdd->prepare($sql);

        $req->bindValue(':statut', $reservation->getStatut());
        $req->bindValue(':qte_plein_tarif', $reservation->getQtePleinTarif(), PDO::PARAM_INT);
        $req->bindValue(':qte_etudiant', $reservation->getQteEtudiant(), PDO::PARAM_INT);
        $req->bindValue(':qte_senior', $reservation->getQteSenior(), PDO::PARAM_INT);
        $req->bindValue(':moyen_paiement', $reservation->getMoyenPaiement());
        $req->bindValue(':ref_seance', $reservation->getRefSeance(), PDO::PARAM_INT);
        $req->bindValue(':ref_code', $reservation->getRefCode(), PDO::PARAM_INT);
        $req->bindValue(':ref_acteur', $reservation->getRefActeur(), PDO::PARAM_INT);

        return $req->execute();
    }

    public function supprimerReservation(Reservation $reservation)
    {
        $sql = "DELETE FROM reservation WHERE id_reservation = :id_reservation";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_reservation', $reservation->getIdReservation(), PDO::PARAM_INT);

        return $req->execute();
    }

    public function modifierReservation(Reservation $reservation)
    {
        $sql = "UPDATE reservation SET 
                    statut = :statut, 
                    qte_plein_tarif = :qte_plein_tarif, 
                    qte_etudiant = :qte_etudiant, 
                    qte_senior = :qte_senior, 
                    moyen_paiement = :moyen_paiement, 
                    ref_seance = :ref_seance,
                    ref_code = :ref_code,
                    ref_acteur = :ref_acteur
                WHERE id_reservation = :id_reservation";

        $req = $this->connexionBdd->prepare($sql);

        $req->bindValue(':statut', $reservation->getStatut());
        $req->bindValue(':qte_plein_tarif', $reservation->getQtePleinTarif(), PDO::PARAM_INT);
        $req->bindValue(':qte_etudiant', $reservation->getQteEtudiant(), PDO::PARAM_INT);
        $req->bindValue(':qte_senior', $reservation->getQteSenior(), PDO::PARAM_INT);
        $req->bindValue(':moyen_paiement', $reservation->getMoyenPaiement());
        $req->bindValue(':ref_seance', $reservation->getRefSeance(), PDO::PARAM_INT);
        $req->bindValue(':ref_code', $reservation->getRefCode(), PDO::PARAM_INT);
        $req->bindValue(':ref_acteur', $reservation->getRefActeur(), PDO::PARAM_INT);
        $req->bindValue(':id_reservation', $reservation->getIdReservation(), PDO::PARAM_INT);

        return $req->execute();
    }

    public function getReservationsByActeur($id_acteur)
    {
        $sql = "SELECT * FROM reservation WHERE ref_acteur = :id_acteur ORDER BY id_reservation DESC";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_acteur', $id_acteur, PDO::PARAM_INT);
        $req->execute();

        $results = $req->fetchAll(PDO::FETCH_ASSOC);
        $tabReservations = [];

        foreach ($results as $result) {
            $tabReservations[] = new Reservation(
                $result["id_reservation"],
                $result["statut"],
                $result["qte_plein_tarif"],
                $result["qte_etudiant"],
                $result["qte_senior"],
                $result["moyen_paiement"],
                $result["ref_seance"],
                $result["ref_code"],
                $result["ref_acteur"]
            );
        }

        return $tabReservations;
    }

    public function getReservationByActeurEtSeance($id_acteur, $id_seance)
    { //utile pour la logique d'une seule reservation par seance par client
        $sql = "SELECT * FROM reservation WHERE ref_acteur = :id_acteur AND ref_seance = :id_seance";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_acteur', $id_acteur);
        $req->bindValue(':id_seance', $id_seance);
        $req->execute();
        return $req->fetch();
    }

    public function getNombrePlacesReservees($id_seance)
    {
        $sql = "SELECT SUM(qte_plein_tarif+qte_etudiant+qte_senior) as total FROM reservation WHERE ref_seance = :id_seance and statut !='annulee'";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_seance', $id_seance);
        $req->execute();
        $result = $req->fetch();
        if ($result["total"] == null) {
            return 0;
        }
        return $result["total"];

    }

    public function getReservationsBySeance($id_seance)
    {
        $sql = "SELECT * FROM reservation WHERE ref_seance = :id_seance";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_seance', $id_seance);
        $req->execute();
        $results = $req->fetchAll();
        $tabReservations = array();
        foreach ($results as $result) {
            $tabReservations[] = new Reservation(
                $result["id_reservation"],
                $result["statut"],
                $result["qte_plein_tarif"],
                $result["qte_etudiant"],
                $result["qte_senior"],
                $result["moyen_paiement"],
                $result["ref_seance"],
                $result["ref_code"],
                $result["ref_acteur"]
            );
        }
        return $tabReservations;
    }
}