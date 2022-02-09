package nim;

import controler.Controleur;
import modele.modele;
import vue.vue;

// Ici, on importe nos trois packages et on code notre fonction main, qui permet de lancer le jeu.

public class JeuNim {
    public static void main(String[] args) throws CloneNotSupportedException {
        vue.Ihm ihm = new vue.Ihm();
        Controleur.ConstructeurJeu constructeurJeu = new Controleur.ConstructeurJeu(ihm);
        constructeurJeu.construireJeu();
        modele.Tas lesTas = constructeurJeu.getPlateau();
        Controleur.ControleurJeu controleurJeu = new Controleur.ControleurJeu(ihm, lesTas);
        controleurJeu.CommencerJeu();
    }
}
