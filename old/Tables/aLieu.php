<?php

class aLieu
{

    private $_idlieu;
    private $_idevent;

    public function __construct($idlieu, $idevent, $args)
    {
        switch ($args) {
            case 2:
                $this->setIdLieu($idlieu);
                $this->setIdEvent($idevent);
                break;
            default:
                echo "Le nombre d'argument est incorrect ! ";
                $this->__destruct();
        }
    }

    public function setIdLieu($idlieu)
    {
        $this->_idlieu = $idlieu;
    }

    public function setIdEvent($idevent)
    {
        $this->_idevent = $idevent;
    }

    public function getIdLieu()
    {
        return this->_idlieu;
    }

    public function getIdEvent()
    {
        return this->_idevent;
    }

    
}
