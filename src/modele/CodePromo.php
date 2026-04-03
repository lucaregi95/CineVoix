<?php
class CodePromo
{
    private $idCodePromo;
    private $codePromo;
    private $pourcentageReduction;
    private $etat;

    /**
     * @param $idCodePromo
     * @param $codePromo
     * @param $pourcentageReduction
     * @param $etat
     */
    public function __construct($idCodePromo, $codePromo, $pourcentageReduction, $etat)
    {
        $this->idCodePromo = $idCodePromo;
        $this->codePromo = $codePromo;
        $this->pourcentageReduction = $pourcentageReduction;
        $this->etat = $etat;
    }

    /**
     * @return mixed
     */
    public function getIdCodePromo()
    {
        return $this->idCodePromo;
    }

    /**
     * @return mixed
     */
    public function getCodePromo()
    {
        return $this->codePromo;
    }

    /**
     * @return mixed
     */
    public function getPourcentageReduction()
    {
        return $this->pourcentageReduction;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $idCodePromo
     */
    public function setIdCodePromo($idCodePromo)
    {
        $this->idCodePromo = $idCodePromo;
    }

    /**
     * @param mixed $codePromo
     */
    public function setCodePromo($codePromo)
    {
        $this->codePromo = $codePromo;
    }

    /**
     * @param mixed $pourcentageReduction
     */
    public function setPourcentageReduction($pourcentageReduction)
    {
        if($pourcentageReduction<0){
            echo "veuillez renseignez un nombre valide (au dessus de 0)";
        }else{
            $this->pourcentageReduction = $pourcentageReduction;
        }
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }


}