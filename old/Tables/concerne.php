<?php

class concerne
{

    private $_idevent;
    private $_idtheme;

    public function __construct($idevent, $idtheme, $args)
    {
        switch ($args) {
            case 2:
                $this->setIdEvent($idevent);
                $this->setIdTheme($idtheme);
                break;
            default:
                echo "Le nombre d'argument est incorrect ! ";
                $this->__destruct();
        }
    }

    public function setIdEvent($idevent)
    {
        $this->_idevent = $idevent;
    }

    public function setIdTheme($idtheme)
    {
        $this->_idtheme = $idtheme;
    }

    public function getIdEvent()
    {
        return this->_idevent;
    }

    public function getIdTheme()
    {
        return this->_idtheme;
    }

    
}
