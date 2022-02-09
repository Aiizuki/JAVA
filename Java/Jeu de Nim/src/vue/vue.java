package vue;
import controler.Controleur;
import modele.*;
import java.util.Scanner;
import java.util.Arrays;

public class vue {

    public static class Ihm {

        public Ihm() {}

        public static modele.Joueur CreateJoueur(int i){
            Scanner input_j = new Scanner(System.in);
            System.out.println("Donnez le nom du joueur "+i+" :");
            String userName = input_j.nextLine();
            modele.Joueur J1 = new modele.Joueur(userName);
            return J1;
        }

        public static modele.Tas CreateJeu(){
            Scanner input_t = new Scanner(System.in);
            System.out.println("Donnez le nombre de tas d'allumettes");
            String nbTas = input_t.nextLine();
            modele.Tas Tas = new modele.Tas(Integer.parseInt(nbTas));
            return Tas;
        }

        public static int [] JouerCoup(String i){
            int [] result = new int [2];
            Scanner input_n = new Scanner(System.in);
            Scanner input_l = new Scanner(System.in);
            System.out.println("Joueur"+" "+i+" "+"A vous de jouer !");
            System.out.println("Sur quel tas souhaitez-vous retirer des allumettes");
            String ligne = input_l.nextLine();
            try {
                result[0] = Integer.parseInt(ligne);
            }
            catch(Exception e) {
                result[0] = 99;
                return result;
            }
            System.out.println("Combien d'allumettes souhaitez-vous retirer ?");
            String nb_retirer = input_n.nextLine();
            try{
                result[1]= Integer.parseInt(nb_retirer);
            }
            catch(Exception e) {
                result[1] = 99;
                return result;
            }
            return result;
        }

        public static String AfficherPlateau(modele.Tas x) {
            String[][] p;
            String a = "";
            p = new String[x.getNbrTas()][x.getNbrTas() * 2 - 1];
            for (int i = 0; i < x.getNbrTas(); i++) {
                for (int j = 0; j < x.getNbrTas() * 2 - 1; j++) {
                    if (x.Tableau[i][j] == 0) {
                        a = a + " ";
                    } else {
                        a = a + "|";
                    }
                }
                System.out.println(a);
                a = "";
            }
            return "=====================";
        }

        public static String AfficherErreur(int i){
            if(i == 99) {
                System.out.println("Coup Impossible car pas assez d'allumettes");
                return "done";
            }
            else if (i == 98) {
                System.out.println("Saisie incorrecte");
                return "done";
            }

            else {
                return "done";
            }
        }

        public static String FinDeJeu(String k){
            System.out.println("Fin de la partie, victoire de : "+k);
            return "done";
        }

        public static int Rejouer(){
            Scanner input_r = new Scanner(System.in);
            System.out.println("Souhaitez vous rejouer ?");
            System.out.println("1 = oui || 2 = non");
            String rejouer = input_r.nextLine();
            int result = Integer.parseInt(rejouer);
            return result;
        }

        public static String Endgame(modele.Joueur x, modele.Joueur y){
            System.out.println("Score final : ");
            System.out.println(x.getNom()+ " : " + x.getNbWin() + " || " + y.getNom() + " : "+ y.getNbWin());
            return "done";
        }

        public static String Ntm(){
            System.out.println("Valeur non comprise. Merci de sélectionner une valeur valide." );
            return "ntm";
        }

        public static String NewGame(){
            System.out.println("================================================================================");
            return "done";
        }
    }
}
