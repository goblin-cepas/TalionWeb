<?php
class aLieuManager
{

    private $_db;

    public function __construct($dbh)
    {
        $this->setDb($dbh);
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
 
    public function add(aLieu $aLieu)
    {
        $q = $this->_db->prepare('INSERT INTO a_lieu(idlieu, idevent) VALUES(:idlieu, :idevent)');
        $q->bindvalue(':idlieu', $aLieu->getIdLieu(), PDO::PARAM_INT);
        $q->bindvalue(':idevent', $aLieu->getIdEvent(), PDO::PARAM_INT);
        $q->execute();
    }
}
