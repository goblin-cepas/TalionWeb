<?php

class personnage {

// <editor-fold defaultstate="collapsed" desc="Attributs">

    private $_Id;
    private $_Nom;
    private $_Experience;
    private $_Credit;
    private $_Mouvement;
    private $_CapaciteDeCorpsACorps;
    private $_CapaciteDeTir;
    private $_Force;
    private $_Endurance;
    private $_PointDeVie;
    private $_Initiative;
    private $_Attaque;
    private $_Commandement;
    private $_SangFroid;
    private $_Volonte;
    private $_Intelligence;
    private $_Recuperation;
    private $_Progression;
    private $_Type;
    private $_Id_gang;

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Constructeur">

    public function __construct($id, $nom, $experience, $credit, $mouvement, $capacitedecorpsacorps, $capacitedetir, $force, $endurance, $pointdevie, $initiative, $attaque, $commandement, $sangfroid, $volonte, $intelligence, $recuperation, $progression, $type, $idgang, $args) {
        switch ($args) {
            case 2:
                $this->setNom($nom);
                $this->setIdGang($idgang);
                break;
            case 20:
                $this->setId($id);
                $this->setIdGang($idgang);
                $this->setNom($nom);
                $this->setExperience($experience);
                $this->setCredit($credit);
                $this->setMouvement($mouvement);
                $this->setCC($capacitedecorpsacorps);
                $this->setCT($capacitedetir);
                $this->setForce($force);
                $this->setEndurance($endurance);
                $this->setPV($pointdevie);
                $this->setInitiative($initiative);
                $this->setAttaque($attaque);
                $this->setCommandement($commandement);
                $this->setSangFroid($sangfroid);
                $this->setVolonte($volonte);
                $this->setIntelligence($intelligence);
                $this->setRecuperation($recuperation);
                $this->setProgression($progression);
                $this->setType($type);
                break;
            default:
                echo "Erreur, le nombre d'argument est incorrect";
                $this->__desctruct();
                break;
        }
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Accesseurs">
    public function getId() {
        return $this->_Id;
    }

    private function setId($id) {
        $this->_Id = $id;
    }

    public function getNom() {
        return $this->_Nom;
    }

    private function setNom($Nom) {
        $this->_Nom = $Nom;
    }

    public function getExperience() {
        return $this->_Experience;
    }

    private function setExperience($Experience) {
        $this->_Experience = $Experience;
    }

    public function getCredit() {
        return $this->_Credit;
    }

    private function setCredit($Credit) {
        $this->_Credit = $Credit;
    }

    public function getMouvement() {
        return $this->_Mouvement;
    }

    private function setMouvement($Mouvement) {
        $this->_Mouvement = $Mouvement;
    }

    public function getCC() {
        return $this->_CapaciteDeCorpsACorps;
    }

    private function setCC($CapaciteDeCorpsACorps) {
        $this->_CapaciteDeCorpsACorps = $CapaciteDeCorpsACorps;
    }

    public function getCT() {
        return $this->_CapaciteDeTir;
    }

    private function setCT($CapaciteDeTir) {
        $this->_CapaciteDeTir = $CapaciteDeTir;
    }

    public function getForce() {
        return $this->_Force;
    }

    private function setForce($Force) {
        $this->_Force = $Force;
    }

    public function getEndurance() {
        return $this->_Endurance;
    }

    private function setEndurance($Endurance) {
        $this->_Endurance = $Endurance;
    }

    public function getPV() {
        return $this->_PointDeVie;
    }

    private function setPV($PointDeVie) {
        $this->_PointDeVie = $PointDeVie;
    }

    public function getInitiative() {
        return $this->_Initiative;
    }

    private function setInitiative($Initiative) {
        $this->_Initiative = $Initiative;
    }

    public function getAttaque() {
        return $this->_Attaque;
    }

    private function setAttaque($Attaque) {
        $this->_Attaque = $Attaque;
    }

    public function getCommandement() {
        return $this->_Commandement;
    }

    private function setCommandement($Commandement) {
        $this->_Commandement = $Commandement;
    }

    public function getSangFroid() {
        return $this->_SangFroid;
    }

    private function setSangFroid($SangFroid) {
        $this->_SangFroid = $SangFroid;
    }

    public function getVolonte() {
        return $this->_Volonte;
    }

    private function setVolonte($Volonte) {
        $this->_Volonte = $Volonte;
    }

    public function getIntelligence() {
        return $this->_Intelligence;
    }

    private function setIntelligence($Intelligence) {
        $this->_Intelligence = $Intelligence;
    }

    public function getRecuperation() {
        return $this->_Recuperation;
    }

    private function setRecuperation($Recuperation) {
        $this->_Recuperation = $Recuperation;
    }

    public function getProgression() {
        return $this->_Progression;
    }

    private function setProgression($Progression) {
        $this->_Progression = $Progression;
    }

    public function getType() {
        return $this->_Type;
    }

    private function setType($Type) {
        $this->_Type = $Type;
    }

    public function getIdGang() {
        return $this->_Id_gang;
    }

    private function setIdGang($Id_gang) {
        $this->_Id_gang = $Id_gang;
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Méthodes">
// </editor-fold>
}
