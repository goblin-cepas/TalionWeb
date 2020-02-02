<?php 
class noteManager {

    private $_db;

    public function __construct($dbh) {
        $this->setDb($dbh);
    }

    public function setDb(PDO $db) {
        $this->_db = $db;
    }

    public function add(note $note) {
        $q = $this->_db->prepare('INSERT INTO note(idevent,idvisit,note,commentaire) VALUES(:idevent, :idvisit, :note, :commentaire)');
        $q->bindvalue(':idevent', $note->getIdEvent(), PDO::PARAM_INT);
        $q->bindvalue(':idvisit', $note->getIdVisit(), PDO::PARAM_INT);
        $q->bindvalue(':note', $note->getNote(), PDO::PARAM_STR);
        $q->bindvalue(':commentaire', $note->getCommentaire(), PDO::PARAM_STR);
        $q->execute();
    }

    public function selectAll() {
        $q = $this->_db->prepare('SELECT * FROM note');
        $q->execute();
        $check = $q->fetch(PDO::FETCH_BOUND);
        return $check;
    }

    public function removeOneByIdEvent(note $note) {
        $q = $this->_db->prepare('DELETE FROM note WHERE idevent = :idevent');
        $q->bindvalue(':idevent', $note->getIdEvent(), PDO::PARAM_INT);
        $q->execute();
    }
}
