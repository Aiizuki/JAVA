package controler;
import modele.*;
import vue.*;

import java.lang.module.FindException;
import java.util.Arrays;


public class Controleur {

    public static class ConstructeurJeu {

        private static modele.Joueur J1;
        private static modele.Joueur J2;
        private static modele.Tas LesTas;
        private static modele.Tas Plateau;
        private static vue.Ihm x;


        public ConstructeurJeu(vue.Ihm x) {
            this.x = x;
        }

        public boolean construireJeu() throws CloneNotSupportedException {
            this.J1 = x.CreateJoueur(1);
            this.J2 = x.CreateJoueur(2);
            this.LesTas = x.CreateJeu();
            this.Plateau = (modele.Tas) LesTas.clone();
            return true;
        }

        public static String getJ(modele.Joueur i) {
            return i.getNom();
        }

        public static modele.Tas getPlateau() {
            return Plateau;
        }

    }

    public static class ControleurJeu {

        public ControleurJeu(vue.Ihm LaVue, modele.Tas LePlateau) {

        }

        public int[][] Tour(String i) {
            int [][] FuturTab;
            int[] leCoup = vue.Ihm.JouerCoup(i);
            if (leCoup[0] == 99 || leCoup[1] == 99 ){
                FuturTab = new int [1][1];
                FuturTab[0][0] = 98;
            }
            else{
                modele.Coup C = new modele.Coup(leCoup[0], leCoup[1]);
                FuturTab = modele.Tas.RetirerAllumettes(C, ConstructeurJeu.Plateau.Tableau);
            }
            return FuturTab;
        }


        public String commencerJeu() {
            int TourJoueur = 1;
            int i = 1;
            int NbrDeTour = 0;
            boolean vainqueur = false;
            boolean FinDeJeu = false;
            boolean FinDeVie = false;
            while (FinDeJeu == false) {
                vainqueur = modele.Tas.VerifeSiVainqueur(ConstructeurJeu.Plateau.Tableau);
                vue.Ihm.AfficherPlateau(ConstructeurJeu.Plateau);
                if (vainqueur == true) {
                    if (TourJoueur == 1) {
                        FinDeJeu = true;
                        ConstructeurJeu.J2.setNbWin();
                        vue.Ihm.FinDeJeu(ConstructeurJeu.J2.getNom());
                    } else {
                        FinDeJeu = true;
                        ConstructeurJeu.J1.setNbWin();
                        vue.Ihm.FinDeJeu(ConstructeurJeu.J1.getNom());
                    }
                } else if (vainqueur == false && TourJoueur == 1) {
                    int[][] FuturTab = Tour(ConstructeurJeu.getJ(ConstructeurJeu.J1));
                    if (FuturTab[0][0] != 99 && FuturTab[0][0] != 98) {
                        TourJoueur = 2;
                    } else {
                        vue.Ihm.AfficherErreur(FuturTab[0][0]);
                    }
                } else if (vainqueur == false && TourJoueur == 2) {
                    int[][] FuturTab = Tour(ConstructeurJeu.getJ(ConstructeurJeu.J2));
                    if (FuturTab[0][0] != 99 && FuturTab[0][0] != 98) {
                        TourJoueur = 1;
                        NbrDeTour++;
                    } else {
                        vue.Ihm.AfficherErreur(FuturTab[0][0]);
                    }
                }
            }
            while (FinDeJeu == true && FinDeVie == false) {
                int y = vue.Ihm.Rejouer();
                if (1 == y) {
                    try {
                        ConstructeurJeu.Plateau = ConstructeurJeu.LesTas.clone();
                    } catch (CloneNotSupportedException e) {
                        e.printStackTrace();
                    }
                    commencerJeu();
                } else if (2 == y) {
                    FinDeVie = true;
                    vue.Ihm.Endgame(ConstructeurJeu.J1, ConstructeurJeu.J2);
                } else {
                    vue.Ihm.Ntm();
                }
            }
            return "done";
        }
    }
}
