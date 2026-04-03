<?php
class CodePromoRepository
{
    private $connexionBdd;
    public function __construct()
    {
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }

    public function getCodePromo($idCodePromo){
        $sql = "SELECT * FROM CodePromo WHERE id_code = :idCodePromo";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':idCodePromo', $idCodePromo);
        $req->execute();
        $result = $req->fetch();
        $codePromo = new CodePromo($result["id_code_promo"],$result["code_promo"],$result["pourcentage_reduction"],$result["etat"]);
        return $codePromo;
    }

    public function getAllCodePromo(){
        $sql = "SELECT * FROM CodePromo";
        $req = $this->connexionBdd->prepare($sql);
        $req->execute();
        $results = $req->fetchAll();
        $tabCodePromo = array();
        foreach ($results as $result) {
            $codePromo = new CodePromo($result["id_code_promo"],$result["code_promo"],$result["pourcentage_reduction"],$result["etat"]);
        $tabCodePromo[] = $codePromo;
        }
        return $tabCodePromo;
    }

    public function ajouterCodePromo(CodePromo $codePromo){
        $sql= "INSERT INTO VALUES :id_code, :code, :pourcentage_reduction, :etat";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_code', $codePromo->getidCodePromo());
        $req->bindValue(':code', $codePromo->getCodePromo());
        $req->bindValue(':pourcentage_reduction', $codePromo->getPourcentageReduction());
        $req->bindValue(':etat', $codePromo->getEtat());
        $req->execute();
    }
}