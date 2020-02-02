<?php

class gangManager {

    private $_db;

    public function __construct($dbh) {
        $this->setDb($dbh);
    }

    public function setDb(PDO $db) {
        $this->_db = $db;
    }

    public function add(gang $gang) {
        $q = $this->_db->prepare('INSERT INTO Gang(nom_Gang, maison_Gang, valeur_Gang, reputation_Gang, tailleTerritoire_Gang, magot_Gang, Id_Utilisateur) VALUES( :nom, :maison, :valeur, :reputation, :tailleTerritoire, :magot, :idUser)');
        $q->bindValue(':nom', $gang->getNom(), PDO::PARAM_STR);
        $q->bindValue(':maison', $gang->getMaison(), PDO::PARAM_STR);
        $q->bindValue(':valeur', $gang->getValeur(), PDO::PARAM_INT);
        $q->bindValue(':reputation', $gang->getReputation(), PDO::PARAM_INT);
        $q->bindValue(':tailleTerritoire', $gang->getTailleTerritoire(), PDO::PARAM_INT);
        $q->bindValue(':magot', $gang->getMagot(), PDO::PARAM_INT);
        $q->bindValue(':idUser', $gang->getIdUtilisateur(), PDO::PARAM_INT);
        $q->execute();
    }

    public function update(gang $gang) {
        $q = $this->_db->prepare('UPDATE Gang SET nom_Gang = :nom, maison_Gang = :maison, valeur_Gang = :valeur, reputation_Gang = :reputation, tailleTerritoire_Gang = :tailleTerritoire, magot_Gang = :magot WHERE Id_Gang = :id');

        $q->bindValue(':id', (int) $gang->getId(), PDO::PARAM_INT);
        $q->bindValue(':nom', $gang->getNom(), PDO::PARAM_STR);
        $q->bindValue(':maison', $gang->getMaison(), PDO::PARAM_STR);
        $q->bindValue(':valeur', (int) $gang->getValeur(), PDO::PARAM_INT);
        $q->bindValue(':reputation', (int) $gang->getReputation(), PDO::PARAM_INT);
        $q->bindValue(':tailleTerritoire', (int) $gang->getTailleTerritoire(), PDO::PARAM_INT);
        $q->bindValue(':magot', (int) $gang->getMagot(), PDO::PARAM_INT);
        $q->bindValue(':idUser', (int) $gang->getIdUtilisateur(), PDO::PARAM_INT);

        $q->execute();
    }

    public function getGangByIdUserList($idUser) {

        $gangs = array();
        $q = $this->_db->prepare('SELECT * FROM Gang WHERE Id_Utilisateur = :idUser');

        $q->bindValue(':idUser', $idUser, PDO::PARAM_INT);
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $gang = array();
            $gang['Id_Gang'] = $donnees['Id_Gang'];
            $gang['nom_Gang'] = $donnees['nom_Gang'];
            $gang['maison_Gang'] = $donnees['maison_Gang'];
            $gang['valeur_Gang'] = $donnees['valeur_Gang'];
            $gang['reputation_Gang'] = $donnees['reputation_Gang'];
            $gang['tailleTerritoire_Gang'] = $donnees['tailleTerritoire_Gang'];
            $gang['magot_Gang'] = $donnees['magot_Gang'];
            $gang['Id_Utilisateur'] = $donnees['Id_Utilisateur'];
            array_push($gangs, $gang);
            unset($gang);
        }
        return $gangs;
    }

    public function getGangById($id) {
        $gang = array();
        $q = $this->_db->prepare('SELECT * FROM Gang WHERE Id_Gang = :id');

        $q->bindValue(':id', $id, PDO::PARAM_INT);
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $gang['Id_Gang'] = $donnees['Id_Gang'];
            $gang['nom_Gang'] = $donnees['nom_Gang'];
            $gang['maison_Gang'] = $donnees['maison_Gang'];
            $gang['valeur_Gang'] = $donnees['valeur_Gang'];
            $gang['reputation_Gang'] = $donnees['reputation_Gang'];
            $gang['tailleTerritoire_Gang'] = $donnees['tailleTerritoire_Gang'];
            $gang['magot_Gang'] = $donnees['magot_Gang'];
            $gang['Id_Utilisateur'] = $donnees['Id_Utilisateur'];
        }

        return $gang;
    }

    public function updateMagot(gang $gang) {
        $q = $this->_db->prepare('UPDATE Gang SET magot_Gang = :magot WHERE Id_Gang = :id');

        $q->bindValue(':id', $gang->getId(), PDO::PARAM_INT);
        $q->bindValue(':magot', $gang->getMagot(), PDO::PARAM_INT);

        $q->execute();
    }
    
}
