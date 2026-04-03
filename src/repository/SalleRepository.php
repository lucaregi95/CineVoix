<?php
class SalleRepository
{
    private $connexionBdd;
    public function __construct(){
        $this->connexionBdd=(new Bdd())->getConnexionBdd();
    }

    public function getSalle($id_salle){
        $sql="SELECT * FROM salle WHERE id_salle=:id_salle";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_salle',$id_salle);
        $req->execute();
        $result = $req->fetch();
        $salle = new Salle($result["id_salle"], $result["code"], $result["nom"], $result["capacite"], $result["prix"], $result["etat"]);
        return $salle;
    }

    public function getALlSalle(){
        $sql="SELECT * FROM salle";
        $req = $this->connexionBdd->prepare($sql);
        $req->execute();
        $results = $req->fetchAll();
        $tabSalle = array();
        foreach($results as $result){
            $salle = new Salle($result["id_salle"], $result["code"], $result["nom"], $result["capacite"], $result["etat"]);
        $tabSalle[] = $salle;
        }
        return $tabSalle;
    }

    public function ajouterSalle(Salle $salle){
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_salle',$salle->getIdSalle());
        $req->bindValue(':code',$salle->getCode());
        $req->bindValue(':nom',$salle->getNom());
        $req->bindValue(':capacite',$salle->getCapacite());
        $req->bindValue(':etat',$salle->getEtat());
        $req->execute();
    }
}