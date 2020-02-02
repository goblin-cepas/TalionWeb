<?php

class creerSupprimerContrib
{

    private $_idContrib;
    private $_idAdmin;
    private $_dateCRE_C_SUP_C;

    public function __construct($idContrib, $idAdmin, $dateCRE_C_SUP_C, $args)
    {
        switch ($args) {
            case 3:
                $this->setIdContrib($idContrib);
                $this->setIdAdmin($idAdmin);
                $this->setDate($dateCRE_C_SUP_C);
                break;
            default:
                echo "Le nombre d'argument est incorrect ! ";
                $this->__destruct();
        }
    }


    public function setIdContrib($idContrib)
    {
        $this->_idContrib = $idContrib;
    }

    public function setIdAdmin($idAdmin)
    {
        $this->_idAdmin = $idAdmin;
    }

    public function setDate($dateCRE_C_SUP_C)
    {
        $this->_dateCRE_C_SUP_C = $dateCRE_C_SUP_C;
    }

    public function getIdContrib()
    {
        return this->_idContrib;
    }

    public function getIdAdmin()
    {
        return this->_idAdmin;
    }

    public function getDate()
    {
        return this->_dateCRE_C_SUP_C;
    }

    
}
