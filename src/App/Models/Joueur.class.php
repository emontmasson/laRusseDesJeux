<?php

namespace App\Models;

use DateTime;

class Joueur extends Utilisateur
{
  // Attribut
  private array $listePartie;

  // permet de déterminer dans une partie qui est le gagnant
  private int $score = 0;
  

  // Constructor
  public function __construct(private int $idUser,
                              protected string $login,
                              private string $mdp,
                              private string $droit,
                              private int $nbParties = 0
  )
  {
   
    $this->listePartie = array();
   
  }
  //Accesseur
  public function __get($name) {
    return $this->$name;
}

public function __set($name, $value) {
    $this->name = $value;
}
  
  //Methodes
  // joue une partie de jeu et détermine le score du joueur

  public function rejoindrePartie(Partie $partie) : void 
  {
    $this->listePartie[] = $partie;

  }

  public function jouerPartie(Partie $partie) {
    $partie->jeu->jouerTour();
    $this->score = $partie->jeu->score;

  }

  public function __toString() {
    return "Le joueur " .$this->idUser." ". $this->login;
  }
}
