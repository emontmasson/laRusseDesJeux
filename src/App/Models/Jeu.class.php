<?php
namespace App\Models;
use App\Models\Partie;

abstract class Jeu
{


    // score du jeu indépendamment du joueur
    protected int $score;

     // Constructor
    public function __construct(private int $idJeu, private ?string $regle = null,  protected array $lstParties = array()){
        $this->lstPartie = $lstParties;
        $this->idJeu = $idJeu;
        $this->regle = $regle;
        $this->score = 0;
    }


    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->name = $value;
    }

    abstract public function jouerTour();

    abstract public function calculerScore();
    
     // Methodes
    public function afficherClassementPartie(){}
    public function top3Partie(){}


}
?>