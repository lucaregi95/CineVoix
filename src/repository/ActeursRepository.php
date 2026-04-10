<?php

class ActeursRepository{
    private $connexionBdd;
    public function __construct()
    {
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }

    public function getActeur($id_Acteurs) {
        $sql = "SELECT * FROM acteurs WHERE id_Acteurs = :id_Acteurs";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':idActeurs', $id_Acteurs);
        $req->execute();
        $result = $req->fetch();
        $acteur = new Acteurs($result["id_Acteur"],$result["nom"],$result["prenom"],$result["email"],$result["date_naissance"],$result["telephone"],$result["rue"],$result["ville"],$result["cp"]);
        return $acteur;
    }

    public function ajouterActeur(Acteurs $acteur){
        $sql= "INSERT INTO acteurs VALUES :id_acteur, :nom, :prenom, :email, :mdp, :tel, :rue, :cp, :ville, :date_naissance,:role,:etat,:date_creation";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_acteur', $acteur->getIdActeur());
        $req->bindValue(':nom', $acteur->getNom());
        $req->bindValue(':prenom', $acteur->getPrenom());
        $req->bindValue(':email', $acteur->getEmail());
        $req->bindValue(':mdp', $acteur->getMdp());
        $req->bindValue(':tel', $acteur->getTelephone());
        $req->bindValue(':rue', $acteur->getRue());
        $req->bindValue(':cp', $acteur->getCp());
        $req->bindValue(':ville', $acteur->getVille());
        $req->bindValue(':date_naissance', $acteur->getDateNaissance());
        $req->bindValue(':role', $acteur->getRole());
        $req->bindValue(':etat', $acteur->getEtat());
        $req->bindValue(':date_creation', $acteur->getDateCreation());
        $req->execute();
    }












}