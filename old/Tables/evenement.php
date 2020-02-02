<?php

class evenement
{
    private $_idevent;
    private $_nomEvent;
    private $_dateEvent;
    private $_effectif_min;
    private $_effectif_max;
    private $_idcontrib;
    private $_idtheme;
    private $_idlieu;
    private $_description;
    private $_dateCRE_E_SUP_E;

    public function __construct($idevent,$nomEvent, $dateEvent, $effectif_min, $effectif_max, $idcontrib, $idtheme,$idlieu,$description, $dateCRE_E_SUP_E, $args)
    {
        switch ($args) {
            case 2:
                $this->setIdEvent($idevent);
                $this->setnomEvent($nomEvent);
                $this->setDateEvent($dateEvent);
                $this->setEffectifMin($effectif_min);
                $this->setEffectifMax($effectif_max);
                $this->setIdContrib($idcontrib);
                $this->setIdTheme($idtheme);
                $this->setIdLieu($idlieu);
                $this->setDescription($description);
                $this->setDate($dateCRE_E_SUP_E);
                break;
            default:
                echo "Le nombre d'argument est incorrect ! ";
        }
    }

    public function setIdEvent($idevent)
    {
        $this->_idevent = $idevent;
    }

    public function setnomEvent($nomEvent){

    $this->_nomEvent = $nomEvent;
    }

    public function setDescription($description) {
        $this->_description = $description;
    }

    public function setIdLieu($idLieu) {
        $this->_idlieu = $idLieu;
    }

    public function setDateEvent($dateEvent)
    {
        $this->_dateEvent = $dateEvent;
    }

    public function setEffectifMin($effectif_min)
    {
        $this->_effectif_min = $effectif_min;
    }

    public function setEffectifMax($effectif_max)
    {
        $this->_effectif_max = $effectif_max;
    }

    public function setIdContrib($idcontrib)
    {
        $this->_idcontrib = $idcontrib;
    }

    public function setIdTheme($idtheme)
    {
        $this->_idtheme = $idtheme;
    }

    public function setDate($dateCRE_E_SUP_E)
    {
        $this->_dateCRE_E_SUP_E = $dateCRE_E_SUP_E;
    }

    public function getDescription() {
        return $this->_description;
    }

    public function getIdEvent()
    {
        return $this->_idevent;
    }

    public function getIdLieu() {
        return $this->_idlieu;
    }

    public function getNomEvent() {
        return $this->_nomEvent;
    }

    public function getDateEvent()
    {
        return $this->_dateEvent;
    }

    public function getEffectifMin()
    {
        return $this->_effectif_min;
    }

    public function getEffectifMax()
    {
        return $this->_effectif_max;
    }

    public function getIdContrib()
    {
        return $this->_idcontrib;
    }

    public function getIdTheme()
    {
        return $this->_idtheme;
    }

    public function getDate()
    {
        return $this->_dateCRE_E_SUP_E;
    }
}
