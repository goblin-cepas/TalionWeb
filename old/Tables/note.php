<?php

class note
{

    private $_idEvent;
    private $_idVisit;
    private $_note;
    private $_commentaire;

    public function __construct($idEvent, $idVisit, $note, $commentaire, $args)
    {
        switch ($args) {
            case 4:
                $this->setIdEvent($idEvent);
                $this->setIdVisit($idVisit);
                $this->setNote($note);
                $this->setCommentaire($commentaire);
                break;
            default:
                echo "Le nombre d'argument est incorrect ! ";
                $this->__destruct();
        }
    }

    public function setIdEvent($idEvent)
    {
        $this->_idEvent = $idEvent;
    }

    public function setIdVisit($idVisit)
    {
        $this->_idVisit = $idVisit;
    }

    public function setNote($note)
    {
        $this->_note = $note;
    }

    public function setCommentaire($commentaire)
    {
        $this->_commentaire = $commentaire;
    }

    public function getIdEvent()
    {
        return this->_idEvent;
    }

    public function getIdVisit()
    {
        return this->_idVisit;
    }

    public function getNote()
    {
        return this->_note;
    }

    public function getCommentaire()
    {
        return this->_commentaire;
    }
}
