<?php

namespace App\Models;

use DateTime;

class Partie
{
    // Attribut 
  
    private DateTime $dateHeure;

    private ?Joueur $gagnant = null;

   
    // Constructor 
    public function __construct(private Jeu $jeu , private int $nbJoueur, private array $lstJoueurs = array(), private int $idPartie = 0)
    {
        $this->dateHeure = new DateTime();
        
    }


   

   

    public function determinerGagnant() {

        
        // on recherche le joueur dont le score est le maximum
        $this->gagnant =  array_reduce($this->lstJoueurs, function($joueur, $joueurAComparer){
            return $joueur ? ($joueur->score > $joueurAComparer->score ? $joueur : $joueurAComparer) : $joueurAComparer;
        });;

    }

    public function __toString() {
        // si le score du gagnant est à 0 ça veut dire qu'il n'y a pas de gagnant
        if($this->gagnant->score == 0) {
            return "Pas de gagnant !";
        }
        else {
            return "Le gagnant est : " . $this->gagnant. " avec un score de ".$this->gagnant->score;
        }
       
    }

    // Accesseur
    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->name = $value;
    }
  
}
