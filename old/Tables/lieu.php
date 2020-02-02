<?php

class lieu
{

    private $_idlieu;
    private $_ville;
    private $_rue;
    private $_numero_rue;
    private $_code_postal;
    private $_position_long;
    private $_position_lat;

    public function __construct($idlieu, $ville, $rue, $numeroRue, $codePostal, $positionLong, $positionLat, $args)
    {
        switch ($args) {
            case 8:
                $this->setIdLieu($idlieu);
                $this->setVille($ville);
                $this->setRue($rue);
                $this->setNumeroRue($numeroRue);
                $this->setCodePostal($codePostal);
                $this->setPositionLong($positionLong);
                $this->setPositionLat($positionLat);
                break;
            default:
                echo "Le nombre d'argument est incorrect ! ";
        }
    }

    public function setIdLieu($idlieu)
    {
        $this->_idlieu = $idlieu;
    }
    public function setVille($ville)
    {
        $this->_ville = $ville;
    }

    public function setRue($rue)
    {
        $this->_rue = $rue;
    }

    public function setNumeroRue($numeroRue)
    {
        $this->_numero_rue = $numeroRue;
    }

    public function setCodePostal($codePostal)
    {
        $this->_code_postal = $codePostal;
    }

    public function setPositionLong($positionLong)
    {
        $this->_position_long = $positionLong;
    }

    public function setPositionLat($positionLat)
    {
        $this->_position_lat = $positionLat;
    }

    public function getIdLieu()
    {
        return $this->_idlieu;
    }


    public function getVille()
    {
        return $this->_ville;
    }

    public function getRue()
    {
        return $this->_rue;
    }

    public function getNumeroRue()
    {
        return $this->_numero_rue;
    }

    public function getCodePostal()
    {
        return $this->_code_postal;
    }

    public function getPositionLong()
    {
        return $this->_position_long;
    }

    public function getPositionLat()
    {
        return $this->_position_lat;
    }
}
