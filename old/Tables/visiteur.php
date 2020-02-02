<?php

class visiteur
{

    private $_idvisit;
    private $_email;
    private $_nom;
    private $_prenom;
    private $_age;
    private $_pseudo;
    private $_password;


    public function __construct($idvisit, $email, $prenom, $nom, $age, $pseudo, $password, $args)
    {
        switch ($args) {
            case 7:
                $this->setIdvisit($idvisit);
                $this->setEmail($email);
                $this->setNom($nom);
                $this->setPrenom($prenom);
                $this->setAge($age);
                $this->setPseudo($pseudo);
                $this->setPassword($password);
                break;
            default:
                echo "Le nombre d'argument est incorrect ! ";
        }
    }



    public function setPrenom($prenom)
    {
        $this->_prenom = $prenom;
    }
    public function getId()
    {
        return $this->_idvisit;
    }

    public function setIdvisit($id)
    {
        $this->_idvisit = $id;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function getNom()
    {
        return $this->_nom;
    }

    public function setNom($nom)
    {
        $this->_nom = $nom;
    }

    public function getPrenom()
    {
        return $this->_prenom;
    }

    public function getAge()
    {
        return $this->_age;
    }

    public function setAge($age)
    {
        $this->_age = $age;
    }

    public function getPseudo()
    {
        return $this->_pseudo;
    }

    public function setPseudo($pseudo)
    {
        $this->_pseudo = $pseudo;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
    }
}
