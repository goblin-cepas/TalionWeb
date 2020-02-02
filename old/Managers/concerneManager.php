<?php
class concerneManager
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

    public function add(concerne $concerne)
    {
        $q = $this->_db->prepare('INSERT INTO concerne(idevent, idtheme) VALUES(:idevent, :idtheme)');
        $q->bindvalue(':idevent', $concerne->getIdEvent(), PDO::PARAM_INT);
        $q->bindvalue(':idtheme', $concerne->getIdTheme(), PDO::PARAM_INT);
        $q->execute();
    }
}
