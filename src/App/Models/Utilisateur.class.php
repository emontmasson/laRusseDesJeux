<?php

namespace App\Models;

class Utilisateur
{
    //Traits(on s'en sert pas pour l'instant.)
    use \App\Traits\ManagerObject;

    // Attribut 
    private int $idUser;
    protected string $login;
    private string $mdp;
    private string $droit;
    // Constructor 
    public function __construct(
        $idUser,
        $login,
        $mdp,
        $droit
    ) {
        $this->idUser = $idUser;
        $this->login = $login;
        $this->mdp = $mdp;
        $this->droit = $droit;
    }
    //Accesseurs

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser 
     * @return self
     */
    public function setIdUser(int $idUser): self
    {
        $this->idUser = $idUser;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getMdp(): string
    {
        return $this->mdp;
    }

    /**
     * @param string $mdp 
     * @return self
     */
    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;
        return $this;
    }

    /**
     * @return string
     */
    public function getDroit(): string
    {
        return $this->droit;
    }

    /**
     * @param string $droit 
     * @return self
     */
    public function setDroit(string $droit): self
    {
        $this->droit = $droit;
        return $this;
    }


    //Methodes
    public function connecter($bool)
    {
    }
    public function deconnecter($bool)
    {
    }
}
