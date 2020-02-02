<?php

class administrateur
{
    private $idadmin;
    private $nom;
    private $prenom;
    private $email;

    public function __construct($idadmin, $nom, $prenom, $email)
    {
        $this->setIdAdmin($idadmin);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setEmail($email);
    }

    public function getIdAdmin()
    {
        return $this->idadmin;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getEmail()
    {
        return $this->email;
    }

    private function setIdAdmin($idadmin)
    {
        $this->idadmin = $idadmin;
    }

    private function setNom($nom)
    {
        $this->nom = $nom;
    }

    private function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    private function setEmail($email)
    {
        $this->email = $email;
    }

}
