<?php

class ActeursRepository{
    private $connexionBdd;
    public function __construct()
    {
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }

    public function getAllActeur($id_Acteurs) {
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
        $req->bindValue(':prenom', $acteur->getPrenom());
        $req->bindValue(':prenom', $acteur->getPrenom());
        $req->bindValue(':prenom', $acteur->getPrenom());
        $req->bindValue(':prenom', $acteur->getPrenom());
        $req->bindValue(':prenom', $acteur->getPrenom());
        $req->bindValue(':prenom', $acteur->getPrenom());
        $req->bindValue(':prenom', $acteur->getPrenom());
        $req->bindValue(':prenom', $acteur->getPrenom());
        $req->bindValue(':etat', $acteur->getEtat());
        $req->execute();
    }



    public function modifierActeur(){
        $sql = 'UPDATE acteurs SET nom = :nom , prenom = :prenom , mdp = :mdp , cp = :cp , ville = : ville , rue = :rue WHERE id_Acteurs = :id_Acteurs';
        $req = $this->connexionBdd->prepare($sql);
        //$req->execute(array(
        //'nom' =>$nom,
        //'prenom' => $prenom,
        // 'mdp' => $mdp,
        // 'cp' => $cp,
        // 'ville' => $ville,
        // 'rue' => $rue,
    //));

        $req->bindValue(':nom', $_POST['nom']);
        $req->bindValue(':prenom', $_POST['prenom']);
        $req->bindValue(':mdp', $_POST['mdp']);
        $req->bindValue(':cp', $_POST['cp']);
        $req->bindValue(':id_Acteurs', $_POST['id_Acteurs']);
        $req->execute();





    }











}