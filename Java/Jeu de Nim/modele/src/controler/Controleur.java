package controler;
//On importe les packages modele et vue
import modele.*;
import vue.*;

public class Controleur {

    public static class ConstructeurJeu {
        // On commence par générer tous les objets et valeurs qu'on appellera plus tard
        private static modele.Joueur J1;
        private static modele.Joueur J2;
        private static modele.Tas LesTas;
        private static modele.Tas Plateau;
        private static vue.Ihm x;
        private static int CoupMax;


        public ConstructeurJeu(vue.Ihm x) {
            this.x = x;
        }
        // On crée un objet vue.Ihm et on le définie comme étant x.

        public void construireJeu() throws CloneNotSupportedException {
            // On demande à l'utilisateur toutes les valeurs pour contruire le jeu ( Nombre de tas, Coup max, Noms des Joueurs )
            LesTas = new modele.Tas(x.CreateJeu());
            while (LesTas.getNbrTas() == -1){
                vue.Ihm.AfficherErreur(-5);
                LesTas = new modele.Tas(x.CreateJeu());
            }
            CoupMax = x.CreateCoupMax();
            while (CoupMax == -1||CoupMax == -2){
                vue.Ihm.AfficherErreur(-3);
                CoupMax = x.CreateCoupMax();
            }
            J1 = new modele.Joueur(x.CreateJoueur(1));
            J2 = new modele.Joueur(x.CreateJoueur(2));
            Plateau = (modele.Tas) LesTas.clone();
        }

        public static modele.Tas getPlateau() {
            // ce getter nous permet de récupérer la plateau (pile de notre clone)
            return Plateau;
        }

    }

    public static class ControleurJeu {

        public ControleurJeu(vue.Ihm LaVue, modele.Tas LePlateau) {

        }

        public int[][] Tour(String i) {
            // cette métode nous permet de jouer un tour pour un joueur, et nous retourne le nouvel état du plateau
            int [][] FuturTab;
            int[] leCoup = vue.Ihm.JouerCoup(i);
            if (leCoup[0] == -2){
                FuturTab = new int [1][1];
                FuturTab[0][0] = -5; // variable d'erreur saisie invalide au niveau du tas
            }
            else if (leCoup[1] == -2){
                FuturTab = new int [1][1];
                FuturTab[0][0] = -2; // variable d'erreur saisie invalide au niveau du nombre d'allumettes
            }
            else if (leCoup[1] > ConstructeurJeu.CoupMax && ConstructeurJeu.CoupMax != 0){
                FuturTab = new int [1][1];
                FuturTab[0][0] = -4; // variable d'erreur si le containte de coup max n'est pas respectée
            }
            else{
                modele.Coup C = new modele.Coup(leCoup[0], leCoup[1]);
                FuturTab = modele.Tas.RetirerAllumettes(C, ConstructeurJeu.Plateau.getTableau()); // application du coup
            }
            return FuturTab; // retourne le nouvel état du plateau
        }


        public void CommencerJeu() {
            // On commence par définir toutes les variables dont on aura besoin
            int TourJoueur = 1;
            boolean vainqueur;
            boolean FinDeJeu = false;
            while (!FinDeJeu) { //Première boucle de jeu, qui répètera les tours jusqu'à ce qu'il y ai un gagnant
                vainqueur = modele.Tas.VerifeSiVainqueur(ConstructeurJeu.Plateau.getTableau());// On verifie si il y a un gagnant
                vue.Ihm.AfficherPlateau(ConstructeurJeu.Plateau.getTableau());// On affiche les tas
                if (vainqueur) { // Si il y a un vainqueur, on détermine quel joueur à gagné grâce au joueur qui a joué en dernier
                    FinDeJeu = true;// on casse la boucle de jeu pour aller à la suite du programme
                    if (TourJoueur == 1) {
                        ConstructeurJeu.J2.setNbWin(); // on ajoute 1 au nombre de victoire de J2
                        vue.Ihm.FinDeJeu(ConstructeurJeu.J2.getNom()); // on affiche au joueur que J2 a gagné ce round
                    } else {
                        ConstructeurJeu.J1.setNbWin(); // on ajoute 1 au nombre de victoire de J1
                        vue.Ihm.FinDeJeu(ConstructeurJeu.J1.getNom()); // on affiche au joueur que J1 a gagné ce round
                    }
                }
                else if (TourJoueur == 1) { // Si il n'y as pas encore de vainqueur et que le joueur qui dois jouer est le joueur 1, on lance le tour du joueur 1
                    int[][] FuturTab = Tour(ConstructeurJeu.J1.getNom());// On joue le tour du joueur 1
                    if (FuturTab[0][0] != -5 && FuturTab[0][0] != -2 && FuturTab[0][0] != -4 && FuturTab[0][0] != -1) { //Si le tableau retourné est valide
                        TourJoueur = 2;// On passe le tour au joueur 2
                        ConstructeurJeu.Plateau.setTableau(FuturTab);// On actualise le tableau
                    } else { //Si le tableau retourné est invalide
                        vue.Ihm.AfficherErreur(FuturTab[0][0]);// on affiche une erreur qui sera spécifique au tableau renvoyé par la méthode "Tour"
                    }
                }
                else { // Si il n'y as pas encore de vainqueur et que le joueur qui dois jouer n'est pas le joueur 1, on lance le tour du joueur 2
                    int[][] FuturTab = Tour(ConstructeurJeu.J2.getNom());// On joue le tour du joueur 2
                    if (FuturTab[0][0] != -5 && FuturTab[0][0] != -2 && FuturTab[0][0] != -4 && FuturTab[0][0] != -1) { //Si le tableau retourné est valide
                        TourJoueur = 1;// On passe le tour au joueur 1
                        ConstructeurJeu.Plateau.setTableau(FuturTab);// On actualise le tableau
                    } else { //Si le tableau retourné est invalide
                        vue.Ihm.AfficherErreur(FuturTab[0][0]);// on affiche une erreur qui seras spécifique au tableau renvoyé par la méthode "Tour"
                    }
                }
            }
            while (true) {// cette boucle est lancée si les joueurs ont finis de jouer
                int y = vue.Ihm.Rejouer();//on demande si ils veulent rejouer
                if (1 == y) {//si les utilisateurs veulent rejouer, on regénère les tas à partir du tas de sauvegarde
                    try {
                        ConstructeurJeu.Plateau = ConstructeurJeu.LesTas.clone();
                    } catch (CloneNotSupportedException e) {
                        e.printStackTrace();
                    }
                    //Puis on sort de la boucle pour relancer le jeu
                    break;
                }
                else if (2 == y) {//si les utilisateurs veulent arrêter de jouer, on affiche les scores de chaque joueurs et on affiche un message pour le vainqueur
                    vue.Ihm.Endgame(ConstructeurJeu.J1.getNom(),ConstructeurJeu.J1.getNbWin(), ConstructeurJeu.J2.getNom(),ConstructeurJeu.J2.getNbWin());
                    if (ConstructeurJeu.J1.getNbWin() > ConstructeurJeu.J2.getNbWin()){
                        vue.Ihm.Vainqueur(ConstructeurJeu.J1.getNom());
                    }
                    else if(ConstructeurJeu.J1.getNbWin() < ConstructeurJeu.J2.getNbWin()){
                        vue.Ihm.Vainqueur(ConstructeurJeu.J2.getNom());
                    }
                    else{
                        vue.Ihm.Vainqueur("");
                    }
                    System.exit(0);//On quitte le jeu pour éviter de relancer une partie en sortant de la boucle while
                }
                else {
                    vue.Ihm.AfficherErreur(-6);
                }
            }
            CommencerJeu();
        }
    }
}
