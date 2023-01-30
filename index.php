 <?php 
    use App\Models\Joueur;
    use  App\Models\JeuBateau;
    use  App\Models\Partie;
    include "autoload.php";
   
   // on créé un joueur
   $j1 = new Joueur (1,"J1","passJ1","user");
   // on créé une instance de joueur
   $j2 = new Joueur(2, "J2", "passJ2", "user");

   // on créé une instance de jeu  de bateau
   $jeuDuBateau = new JeuBateau ();

   // on créé une instance de Partie pour le jeu du bateau pour les joueurs
   $partieCree = new Partie($jeuDuBateau, JeuBateau::NB_JOUEURS, array($j1, $j2));

   // on fait jouer chacun des joueurs
   $j1->jouerPartie($partieCree);

   // on affiche les lancers du joueur
    echo $partieCree->jeu->getHistoriqueDeLancerToString()."<br/>";

    // on fait jouer chacun des joueurs
    $j2->jouerPartie($partieCree);

    // on affiche les lancers du joueur
    echo $partieCree->jeu->getHistoriqueDeLancerToString()."<br/>";

    // on détermine le gagnant
 $partieCree->determinerGagnant();

 // on affiche le gagnant
 echo $partieCree;
   
 
   

 
   
   ?>
