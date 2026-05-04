<?php
class SeancesRepository
{
    private $connexionBdd;
    public function __construct(){
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }

    public function getSeances($seances){
        $sql = "SELECT * FROM seances WHERE id_seance = :seances";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':seances', $seances);
        $req->execute();
        $result = $req->fetch();
        $seance = new Seances($result["id_seance"], $result["date_seance"], $result["ref_film"], $result["ref_salle"]);
        return $seance;
    }

    public function getAllSeances(){
        $sql = "SELECT * FROM seances";
        $req = $this->connexionBdd->prepare($sql);
        $req->execute();
        $results = $req->fetchAll();
        $tabSeances = array();
        foreach($results as $result){
            $seances = new Seances($result["id_seance"], $result["date_seance"], $result["ref_film"], $result["ref_salle"]);
            $tabSeances[] = $seances;
        }
        return $tabSeances;
    }

    public function ajouterSeance(Seances $seance){
        $sql = "INSERT INTO seances VALUES (:id_seance, :date_seance, :ref_film, :ref_salle)";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_seance', $seance->getIdSeance());
        $req->bindValue(':date_seance', $seance->getDateSeance());
        $req->bindValue(':ref_film', $seance->getRefFilm());
        $req->bindValue(':ref_salle', $seance->getRefSalle());
        $req->execute();
    }

    public function modifierSeance(Seances $seance){
        $sql ='UPDATE seances SET date_seance = :date_seance WHERE id_seance = :id_seance';
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':date_seance', $seance->getDateSeance());
        $req->bindValue(':id_seance', $seance->getIdSeance());
        $req->execute();
    }

    public function supprimerSeance(Seances $seance){
        $sql = 'DELETE FROM seances WHERE id_seance = :id_seance';
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_seance', $seance->getIdSeance());
        $req->execute();

    }



}
