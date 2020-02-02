<?php

class theme
{

    private $_idTheme;
    private $_nom;
    private $_categorie;
    private $_idAdminIndex;
    private $_dateCRE_T_SUP_T;

    public function __construct($idtheme, $nom, $categorie, $idAdminIndex, $dateCRE_T_SUP_T, $args)
    {
        switch ($args) {
            case 5:
                $this->setIdTheme($idtheme);
                $this->setNom($nom);
                $this->setCategorie($categorie);
                $this->setIdAdminIndex($idAdminIndex);
                $this->setDate($dateCRE_T_SUP_T);
                break;
            default:
                echo "Le nombre d'argument est incorrect ! ";
                $this->__destruct();
        }
    }


    public function setIdTheme($idtheme)
    {
        $this->_idTheme = $idtheme;
    }

    public function setNom($nom)
    {
        $this->_nom = $nom;
    }

    public function setCategorie($categorie)
    {
        $this->_categorie = $categorie;
    }

    public function setIdAdminIndex($idAdminIndex)
    {
        $this->_idAdminIndex = $idAdminIndex;
    }

    public function setDate($dateCRE_T_SUP_T)
    {
        $this->_dateCRE_T_SUP_T = $dateCRE_T_SUP_T;
    }

    public function getIdTheme()
    {
        return $this->_idTheme;
    }

    public function getNom()
    {
        return $this->_nom;
    }

    public function getCategorie()
    {
        return $this->_categorie;
    }

    public function getIdAdminIndex()
    {
        return $this->_idAdminIndex;
    }

    public function getDate()
    {
        return $this->_dateCRE_T_SUP_T;
    }
    
}
