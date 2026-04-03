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

    public function getInscription(){
        $sql = 'INSERT INTO acteurs(nom,prenom,email,date_naissance,telephone,rue,ville,cp) VALUES (:nom,:prenom, :email, :date_naissance, :telephone, :rue, :ville, :cp)';
        $req = $this->connexionBdd->prepare($sql);
        $req->execute(array(
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'email' => $_POST['email'],
            'date_naissance' => $_POST['date_naissance'],
            'telephone' => $_POST['telephone'],
            'rue' => $_POST['rue'],
            'ville' => $_POST['ville'],
            'cp' => $_POST['cp']
        ));
        $result = $req->fetchall();
        $acteur= new Acteurs($result["id_acteur"],$result["nom"],$result['prenom'],$result['email'],$result['date_naissance'],$result['telephone'],$result['rue'],$result['ville'],$result["cp"]);
        return $acteur;
    }











}