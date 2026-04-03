<?php
class CodePromoRepository
{
    private $connexionBdd;
    public function __construct()
    {
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }

    public function getCodePromo($id_code){
        $sql = "SELECT * FROM codepromo WHERE id_code = :id_code";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_code', $id_code);
        $req->execute();
        $result = $req->fetch();
        $code_promo = new CodePromo($result["id_code"],$result["code"],$result["pourcentage_reduc"],$result["etat"]);
        return $code_promo;
    }

    public function getAllCodePromo(){
        $sql = "SELECT * FROM codepromo";
        $req = $this->connexionBdd->prepare($sql);
        $req->execute();
        $results = $req->fetchAll();
        $tabCodePromo = array();
        foreach ($results as $result) {
            $code = new CodePromo($result["id_code"],$result["code"],$result["pourcentage_reduc"],$result["etat"]);
        $tabCodePromo[] = $code;
        }
        return $tabCodePromo;
    }

    public function ajouterCodePromo(CodePromo $codePromo){
        $sql= "INSERT INTO codepromo VALUES :id_code, :code, :pourcentage_reduction, :etat";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_code', $codePromo->getidCodePromo());
        $req->bindValue(':code', $codePromo->getCodePromo());
        $req->bindValue(':pourcentage_reduction', $codePromo->getPourcentageReduction());
        $req->bindValue(':etat', $codePromo->getEtat());
        $req->execute();
    }
}