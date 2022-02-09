package vue;
//On importe "util.Scanner" afin de pouvoir récupérer les données écrites par l'utilisateur dans le terminal
import java.util.Scanner;

public class vue {

    public static class Ihm {

        public Ihm() {}

        public static String CreateJoueur(int i){
            // Cette méthode reçoit un entier i et permet de demander à l'utilisateur le nom d'un joueur i et renvoie ce nom
            Scanner input_j = new Scanner(System.in);
            System.out.println("Donnez le nom du joueur " + i + " :");
            String J1 = input_j.nextLine();
            return J1;
        }

        public static int CreateJeu() {
            /** Cette méthode permet de demander à l'utilisateur le nombre de tas d'allumettes, vérifie si l'entrée est valide
            et retourne soit un nombre de tas, soit un nombre "marqué" pour que le controleur appelle la fonction AfficherErreur **/
            Scanner input_t = new Scanner(System.in);
            System.out.println("Donnez le nombre de tas d'allumettes");
            try {
                // on teste si ce qu'a donné l'utilisateur est bien un entier
                String nbTas = input_t.nextLine();
                int Tas = Integer.parseInt(nbTas);
                return Tas;
            }
            catch (Exception e){
                // si ce n'est pas le cas, on renvoit un nombre marqué ( ici avec -1 )
                int Tas = -1;
                return Tas;
            }
        }

        public static int CreateCoupMax(){
            /** Cette méthode permet de demander à l'utilisateur le nombre d'allumettes Maximum qu'on peut retirer en un coup,
             vérifie si l'entrée est valide et retourne soit le nombre d'allumettes Maximum qu'on peut retirer en un coup,
             soit un nombre "marqué" pour que le controleur appelle la fonction AfficherErreur **/
            Scanner input_u = new Scanner(System.in);
            System.out.println("Veuillez définir le nombre max d'allumettes retirables par tour (0 si vous n'en voulez pas) :");
            String rep2 = input_u.nextLine();
            try {
                // on teste si ce qu'a donné l'utilisateur est bien un entier
                int CoupMax = Integer.parseInt(rep2);
                return CoupMax;
            }
            catch (Exception e){
                // si ce n'est pas le cas, on renvoit un nombre marqué ( ici avec -2 )
                int CoupMax = -2;
                return CoupMax;
            }
        }

        public static int IA() {
            /** Cette méthode permet de demander à l'utilisateur si il veut rejouer ou non,
             vérifie si l'entrée est valide et retourne soit un entier avec la réponse,
             soit entier "marqué" pour que le controleur appelle la fonction AfficherErreur **/
            Scanner input_r = new Scanner(System.in);
            System.out.println("Souhaitez vous affronter l'IA ?");
            System.out.println("1 = oui || 2 = non");
            String rejouer = input_r.nextLine();
            try {
                int result = Integer.parseInt(rejouer);
                return result;
            }
            catch(Exception e){
                int result = -1;
                return result;
            }

        }

        public static int [] JouerCoup(String i){
            /** Cette méthode permet de demander à l'utilisateur sur quel tas il veut jouer puis combien d'allumettes retirer,
             vérifie si les entrées sont valides et retourne soit un tableau avec le tas et le nombre d'allumettes à retirer,
             soit tableau "marqué" pour que le controleur appelle la fonction AfficherErreur **/
            int [] result = new int [2];
            Scanner input_n = new Scanner(System.in);
            Scanner input_l = new Scanner(System.in);
            System.out.println("Joueur" + " " + i + " " + "A vous de jouer !");
            System.out.println("Sur quel tas souhaitez-vous retirer des allumettes");
            String ligne = input_l.nextLine();
            try {
                // on teste si ce qu'a donné l'utilisateur est bien un entier
                result[0] = Integer.parseInt(ligne);
            }
            catch (Exception e) {
                // si ce n'est pas le cas, on renvoit un tableau marqué ( ici avec -2 )
                result[0] = -2;
                return result;
            }
            System.out.println("Combien d'allumettes souhaitez-vous retirer ?");
            String nb_retirer = input_n.nextLine();
            try {
                // on teste si ce qu'a donné l'utilisateur est bien un entier
                result[1] = Integer.parseInt(nb_retirer);
            }
            catch (Exception e) {
                // si ce n'est pas le cas, on renvoit un tableau marqué ( ici avec -2 )
                result[1] = -2;
                return result;
            }
            return result;
        }

        public static String AfficherPlateau(int [][] Tableau) {
            //Cette méthode parcours le tableau et l'affiche de manière lisible à l'utilisateur
            String ligne = "";
            for (int i = 0; i < Tableau.length; i++) {
                for (int j = 0; j < Tableau.length * 2 - 1; j++) {
                    // Grâce à la double boucle for, on parcours le tableau ligne par ligne puis case par case
                    if (Tableau[i][j] == 0) {
                        ligne = ligne + " ";
                    } else {
                        ligne = ligne + "|";
                    }
                }
                System.out.println(ligne);// on affiche la ligne parcourue
                ligne = "";// on réinitialise la ligne pour passer à la suivante
            }
            return "=====================";
        }

        public static void AfficherErreur(int i){
            // permet, en fonction de l'entier reçu, d'afficher une erreur spécifique
            if(i == -1) {
                System.out.println("Coup Impossible car pas assez d'allumettes");
            }
            else if (i == -2) {
                System.out.println("Saisie incorrecte au niveau du nombres d'allumettes (doit être un nombre entier)");
            }
            else if (i == -3){
                System.out.println("Veuillez saisir un nombre de coup max valide (doit être un nombre entier supérieur à 0.)");
            }
            else if(i == -4) {
                System.out.println("Coup Impossible, contrainte non respectée");
            }
            else if (i == -5) {
                System.out.println("Saisie incorrecte au niveau du tas (doit être un nombre entier supérieur à 0)");
            }
            else if (i == -6) {
                System.out.println("Saisie incorrecte (doit être 1 ou 2)");
            }
            else {
                System.out.println("Erreur pour raison inconnue");
            }
        }

        public static String FinDeJeu(String k){
            // Permet d'afficher un texte de victoire personnalisé en fonction du joueur qui à gagné
            System.out.println("Fin de la partie, victoire de : "+k);
            return "done";
        }

        public static int Rejouer() {
            /** Cette méthode permet de demander à l'utilisateur si il veut rejouer ou non,
             vérifie si l'entrée est valide et retourne soit un entier avec la réponse,
             soit entier "marqué" pour que le controleur appelle la fonction AfficherErreur **/
            Scanner input_r = new Scanner(System.in);
            System.out.println("Souhaitez vous rejouer ?");
            System.out.println("1 = oui || 2 = non");
            String rejouer = input_r.nextLine();
            try {
                int result = Integer.parseInt(rejouer);
                return result;
            }
            catch(Exception e){
                int result = -1;
                return result;
            }

        }

        public static void Endgame(String NomJ1, int ScoreJ1, String NomJ2, int ScoreJ2){
            // Affiche le score final et le nombre de manches gagnées par chaque joueurs
            System.out.println("Score final : ");
            System.out.println(NomJ1 +" : " + ScoreJ1 + " || " + NomJ2 + " : "+ ScoreJ2);
        }

        public static void Vainqueur(String y) {
            // Affiche, soit le vainqueur de la partie, soit équalité
            if (y != "") {
                System.out.println("Victoire de : " + y);
            }
            else{
                System.out.println("Egalité !");
            }
        }
    }
}
