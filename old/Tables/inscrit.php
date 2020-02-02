<?php

class inscrit
{


    private $_idevent;
    private $_idvisit;
    private $_dateINS;

    public function __construct($idevent, $idvisit, $dateINS, $args)
    {
        switch ($args) {
            case 2:
                $this->setIdEvent($idevent);
                $this->setIdVisit($idvisit);
                $this->setDate($dateINS);
                break;
            default:
                echo "Le nombre d'argument est incorrect ! ";
        }
    }

    public function setIdEvent($idevent)
    {
        $this->_idevent = $idevent;
    }

    public function setIdVisit($idvisit)
    {
        $this->_idvisit = $idvisit;
    }

    public function setDate($dateINS)
    {
        $this->_dateINS = $dateINS;
    }

    public function getIdEvent()
    {
        return $this->_idevent;
    }

    public function getIdVisit()
    {
        return $this->_idvisit;
    }

    public function getDate()
    {
        return $this->_dateINS;
    }
}
