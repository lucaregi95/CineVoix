<?php
class CodePromo
{
    private $id_code;
    private $code;
    private $pourcentage_reduc;
    private $etat;

    /**
     * @param $id_code
     * @param $code
     * @param $pourcentage_reduc
     * @param $etat
     */
    public function __construct($id_code, $code, $pourcentage_reduc, $etat)
    {
        $this->id_code = $id_code;
        $this->code = $code;
        $this->pourcentage_reduc = $pourcentage_reduc;
        $this->etat = $etat;
    }

    /**
     * @return mixed
     */
    public function getIdCodePromo()
    {
        return $this->id_code;
    }

    /**
     * @return mixed
     */
    public function getCodePromo()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getPourcentageReduction()
    {
        return $this->pourcentage_reduc;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $id_code
     */
    public function setIdCodePromo($id_code)
    {
        $this->id_code = $id_code;
    }

    /**
     * @param mixed $code
     */
    public function setCodePromo($code)
    {
        $this->code = $code;
    }

    /**
     * @param mixed $pourcentage_reduc
     */
    public function setPourcentageReduction($pourcentage_reduc){
        $this->pourcentage_reduc = $pourcentage_reduc;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }


}