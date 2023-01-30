<?php

namespace App\Models;

abstract class JeuDeDes extends Jeu
{

    protected int $nbDesInitial;
    protected int $nbLancerInitial;

    // Attribut 
    protected int $nbDes;

    protected int $nbLancerDes;

    protected array $tableDeLances;

    private array $tableLancesHistorique;

    protected int $numLancerEnCours;

    


    // Constructor
    public function __construct(int $idJeu, int $nbDes, int $nbLancerDes)
    {

        // permet de définir le nombre de dés et de lancer 
        $this->nbDesInitial = $nbDes;
        $this->nbLancerInitial = $nbLancerDes;

        parent::__construct($idJeu);

    }

    // permet d'initialiser ou de réinitialiser le jeu 
    public function init() {
        
        // permet de réinitialiser le nombre de dés et de lancer par rapport aux valeurs initiales
        $this->nbDes = $this->nbDesInitial;
        $this->nbLancerDes = $this->nbLancerInitial;
        $this->numLancerEnCours = 0;
        $this->score = 0;
        // tableau de dés pour chaque lancé
        $this->tableDeLances = array();
        // historique des lancés de dés
        $this->tableLancesHistorique = array(); 
    }


    // Accesseur      

    public function  getnbDes()
    {
        return $this->nbDes;
    }

    public function  getnbLancerDes()
    {
        return $this->nbLancerDes;
    }
    public function  gettableDeLances()
    {
        return $this->tableDeLances;
    }

    public function setnbDes($nbDes): self
    {
        $this->nbDes = $nbDes;
        return $this;
    }

    // méthode devant être implémentée dans la classe enfant pour traiter le lancer (propre à la règle du jeu de dé)
    abstract protected function traitementLancer(); 

    // méthode devant être implémentée dans la classe enfant pour traiter le score du lancer (propre à la règle du jeu de dé)
    abstract protected function calculerScoreLancer();

    
    
    // Methodes
    
    //Permet de jouer un tour, en effectuant des lancers de dés, un traitement du lancer et du score du lancer
    public function jouerTour()
    {
        $this->init();
            while ($this->nbLancerDes > 0) {
                // génère un tableau de lancer de dés
                $this->lancerDes();
                // traite le lancer
                $this->traitementLancer();
                // traite le score du lancer
                $this->calculerScoreLancer();
                // incrémente le numéro de lancer en cours. il sert au traitement du lancer
                $this->numLancerEnCours++;
                // décrémente le nombre de lancer maximum.
                $this->nbLancerDes--;
            }
        
        
    }


    // implémente la méthode abstraite de Jeu, cela permet d'uniformiser le traitement du score selon le jeu
    public function calculerScore() {
        $this->calculerScoreLancer();
    }

    // on fait un lancé de dés (selon le nombre de dés en jeu)

    public function lancerDes()
    {
        // permet de savoir si on peut encore générer des dés
        $indexDe = 0;
        // tableau du lancer
        $leLancer = array();

        do {
            // le dé lancé
            $de = rand(1, 6);
            // on le met dans le tableau du lancer
            $leLancer[] = $de;
            // on met + 1 pour générer un autre dé
            $indexDe++;
            
            
        } while ($indexDe < $this->nbDes);
       
        // on ajoute le lancer au tableau de lancer pour être traité
        $this->tableDeLances[] = $leLancer;
        // on ajoute le lancer au tableau de lancer pour avoir l'historique et ainsi voir à quel moment on a eu un des membres de l'équipage
        $this->tableLancesHistorique[] = $leLancer;

    }

    // permet de mettre sous forme de chaine de caractère un lancer
    public function getLancerToString(array $lancer) : ?string {
        $lancerString = '';
        foreach ($lancer as $numLancer => $lancer) {
            $lancerString .= "Lancer numéro ".($numLancer+1). ' : ';
            $lancerString .= " | " .implode(' | ', $lancer). " | ";
        }
        if($this->score > 0) {
            $lancerString .= " - Score :" . $this->score;
        }
        else {
            $lancerString .= " - Score : Perdu ! :( ";
        }

        return $lancerString;

    }

    public function getHistoriqueDeLancerToString() : string {
		return $this->getLancerToString($this->tableLancesHistorique);

	}
 
}
