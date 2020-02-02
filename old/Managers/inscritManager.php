<?php
class inscritManager
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

    public function add(inscrit $inscrit)
    {
        $q = $this->_db->prepare('INSERT INTO inscrit(idevent,idvisit,dateINS) VALUES(:idevent, :idvisit, :dateINS)');
        $q->bindvalue(':idevent', $inscrit->getIdEvent(), PDO::PARAM_INT);
        $q->bindvalue(':idvisit', $inscrit->getIdVisit(), PDO::PARAM_INT);
        $q->bindvalue(':dateINS', $inscrit->getDate(), PDO::PARAM_STR);
        $q->execute();
    }
}
