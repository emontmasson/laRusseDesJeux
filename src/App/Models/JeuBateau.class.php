<?php

namespace App\Models;

class JeuBateau extends JeuDeDes
{

	CONST NB_DES_BATEAU = 5;
	CONST NB_LANCER_BATEAU = 3;

	CONST NB_JOUEURS = 2;

	CONST VALEUR_DE_CAPITAINE = 5;
	CONST VALEUR_DE_BATEAU = 6;
	CONST VALEUR_DE_EQUIPAGE = 4;
	
    // Attribut 
    private bool $capitain;
    private bool $equipage;
    private bool $bateau;

    private bool $equipageComplet;

    // Constructor
    public function __construct() {

        parent::__construct(1, self::NB_DES_BATEAU, self::NB_LANCER_BATEAU);
    }
	
	public function init() {
		parent::init();
		$this->capitain = false;
        $this->equipage = false;
        $this->bateau = false;
        $this->equipageComplet = false ;
	}

    // Accesseur  
	/**
	 * @return bool
	 */
	public function getCapitain(): bool {
		return $this->capitain;
	}

	/**
	 * @param bool $capitain 
	 * @return self
	 */
	public function setCapitain(bool $capitain): self {
		$this->capitain = $capitain;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getEquipage(): bool {
		return $this->equipage;
	}

	/**
	 * @param bool $equipage 
	 * @return self
	 */
	public function setEquipage(bool $equipage): self {
		$this->equipage = $equipage;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getBateau(): bool {
		return $this->bateau;
	}
	
	/**
	 * @param bool $bateau 
	 * @return self
	 */
	public function setBateau(bool $bateau): self {
		$this->bateau = $bateau;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getEquipageComplet(): bool {
		return $this->bateau * $this->capitain * $this->equipage;
	}
	
	/**
	 * @param bool $equipageComplet 
	 * @return self
	 */
	public function setEquipageComplet(bool $equipageComplet): self {
		$this->equipageComplet = $equipageComplet;
		return $this;
	}


	private function traiterMembre($valeur, $membre) : void {
		
		// il n'y a pas de bateau
		if($membre == "bateau") {
			$condition = !$this->bateau;
		}
		// il n'y a pas de capitain mais un bateau
		else if($membre == "capitain") {
			$condition = $this->bateau && !$this->capitain;
		}
		// il n'y a pas d'équipage mais un capitaine et un bateau
		else if($membre == "equipage") {
			$condition = $this->bateau && $this->capitain && !$this->equipage;
		}

		// si la condition est remplie et que le dé que l'on recherche est présent dans le tableau
		if ($condition && ($de = array_search($valeur, $this->tableDeLances[$this->numLancerEnCours])) !== false) {
			// on le supprime du tableau de lancé
			unset($this->tableDeLances[$this->numLancerEnCours][$de]);
			$this->$membre = true;
			$this->nbDes--;

		}
	}

	public function traitementLancer() {

		$this->traiterMembre(self::VALEUR_DE_BATEAU, "bateau");
		$this->traiterMembre(self::VALEUR_DE_CAPITAINE, "capitain");
		$this->traiterMembre(self::VALEUR_DE_EQUIPAGE, "equipage");

	}


	private function calculerMiles() {

		if($this->getEquipageComplet()) {	
			$this->score += array_sum($this->tableDeLances[$this->numLancerEnCours]);
		}
		
	}

	public function calculerScoreLancer() {
		$this->calculerMiles();
	}

	
	


}