<?php

class ActeursRepository{
    private $connexionBdd;
    public function __construct()
    {
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }

    public function getActeur($id_acteur) {
        $sql = "SELECT * FROM acteurs WHERE id_acteur = :id_acteur";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_acteur', $id_acteur);
        $req->execute();
        $result = $req->fetch();
        $acteur = new Acteurs($result["id_acteur"],$result["nom"],$result["prenom"],$result["email"], $result["mdp"],$result["date_naissance"],$result["tel"],$result["rue"],$result["ville"],$result["cp"],$result["role"],$result["etat"]);
        return $acteur;
    }
    
    public function getAllActeurs() {
        $sql = "SELECT * FROM acteurs";
        $req = $this->connexionBdd->prepare($sql);
        $req->execute();
        $results = $req->fetchAll();
        $tabActeur = array();
        foreach ($results as $result) {
            $tabActeur[] = new Acteurs($result["id_acteur"],$result["nom"],$result["prenom"],$result["email"], $result["mdp"],$result["date_naissance"],$result["tel"],$result["rue"],$result["ville"],$result["cp"],$result["role"],$result["etat"]);
        }
        return $tabActeur;
    }

    public function ajouterActeur(Acteurs $acteur){
        $sql= "INSERT INTO acteurs VALUES (:id_acteur, :nom, :prenom, :email, :mdp, :tel, :rue, :cp, :ville, :date_naissance,:role,:etat,:date_creation)";
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



    public function modifierActeur(Acteurs $acteurs){
        $sql = 'UPDATE acteurs SET nom = :nom , prenom = :prenom , mdp = :mdp , cp = :cp , ville = :ville , rue = :rue, role=:role, etat=:etat, tel=:tel, date_naissance=:date_naissance WHERE id_acteur = :id_acteur';
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':nom', $acteurs->getNom());
        $req->bindValue(':prenom', $acteurs->getPrenom());
        $req->bindValue(':mdp',  $acteurs->getMdp());
        $req->bindValue(':cp',  $acteurs->getCp());
        $req->bindValue(':ville', $acteurs->getVille());
        $req->bindValue(':rue', $acteurs->getRue());
        $req->bindValue(':role', $acteurs->getRole());
        $req->bindValue(':etat', $acteurs->getEtat());
        $req->bindValue(':tel', $acteurs->getTelephone());
        $req->bindValue(':date_naissance', $acteurs->getDateNaissance());
        $req->bindValue(':id_acteur', $acteurs->getIdActeur());
        $req->execute();
    }
    
    public function supprimerActeur(Acteurs $acteurs){
       
        $sql = 'DELETE FROM acteurs WHERE id_acteur = :id_Acteur';
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_Acteur', $acteurs->getIdActeur());
        $req->execute();
    }

    public function connecterActeur($email, $mdp)
    {
        $sql = "SELECT * FROM acteurs WHERE email = :email AND mdp = :mdp";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':email', $email);
        $req->bindValue(':mdp', $mdp);
        $req->execute();
        return $req->fetch();
    }

}