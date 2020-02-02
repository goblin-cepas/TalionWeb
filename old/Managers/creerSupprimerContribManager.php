<?php
class creerSuppremierContribManager
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

    public function add(creerSuppremierContrib $creerSuppremierContrib)
    {
        $q = $this->_db->prepare('INSERT INTO creer_supprimer_contrib(idcontrib, idadmin, dateCRE_C_SUP_C) VALUES(:idcontrib, :idadmin, :dateCRE_C_SUP_C)');
        $q->bindvalue(':idcontrib', $creerSuppremierContrib->getIdContrib(), PDO::PARAM_INT);
        $q->bindvalue(':idadmin', $creerSuppremierContrib->getIdAdmin(), PDO::PARAM_INT);
        $q->bindvalue(':dateCRE_C_SUP_C', $creerSuppremierContrib->getDate(), PDO::PARAM_INT);
        $q->execute();
    }
}
