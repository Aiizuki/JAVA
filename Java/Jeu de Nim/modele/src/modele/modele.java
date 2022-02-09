package modele;

public class modele {

    public static class Joueur {
        private int NbWin = 0;
        private String Nom;

        public int getNbWin() {
            // Ce getter renvoie le nombre de victoire d'un joueur
            return NbWin;
        }

        public String getNom() {
            // Ce getter renvoie le nom d'un joueur
            return Nom;
        }
        public Joueur(String nom) {
            // Cette méthode prend un nom en paramètre et crée un objet joueur avec comme nom le paramètre et comme nombre de victoires 0.
            this.Nom = nom;
        }

        public void setNbWin() {
            // Ce setter permet d'actualiser le nombre de victoire d'un joueur (à la fin de la partie)
            NbWin = NbWin + 1 ;
        }


    }

    public static class Coup {
        private int NumTas;
        private int NbAllumettes;

        public Coup(int m, int n) {
            // Cette méthode prend deux int m et n et génère un objet Coup avec m=NumTas et n=NbAllumettes
            this.NumTas = m;
            this.NbAllumettes = n;
        }

        public int getNumTas() {
            // Ce getter renvoie le Tas sur lequel le coup doit être appliqué
            return NumTas;
        }

        public int getNbAllumettes() {
            // Ce getter renvoie le nombre d'allumettes à retirer pour ce coup
            return NbAllumettes;
        }
    }

    public static class Tas implements Cloneable {
        private int[][] Tableau;
        private int NumTas;

        public Tas(int NumTas) {
            // Cette méthode prend en paramètre un numéro de Tas et génère un objet Tas, qui correspond à une pile comprenant un certains nombre d'étages ( défini par NumTas) ainsi que le nombre d'allumettes que contiennent chacun de ces étages (généré par la méthode TabAllumettes)
            this.NumTas = NumTas;
            this.Tableau = TabAllumettes(NumTas);
        }

        public int getNbrTas() {
            // Ce getter renvoie le nombre de Tas dans la pile
            return NumTas;
        }

        public int[][] getTableau() {
            // Ce getter renvoie la pile, stockée sous forme d'un tableau d'entiers
            return Tableau;
        }

        public void setTableau(int [][] tableau){
            // Ce setter permet de modifier notre tableau de base par un nouveau (nécessaire pour actualiser le plateau après chaque coup.
            this.Tableau = tableau;
        }

        @Override
         public Tas clone() throws CloneNotSupportedException {
            // Cette méthode permet de générer un clone de notre objet Tas, afin de garder une sauvegarde de l'état initial de la partie
            Tas copie = (Tas) super.clone();
            copie.NumTas = getNbrTas();
            copie.Tableau = new int[NumTas][NumTas*2-1]; // Notre tableau étant en 2D, il nous faut cloner les lignes une par une.
            for (int i = 0; i < Tableau.length; i++){
                copie.Tableau[i] = Tableau[i].clone();
            }
            return copie;
        }


        private int [][] TabAllumettes(int NumTas) {
            // Cette méthode prend en paramètre NumTas ( = nombre d'étages dans notre Pile) et génère un tableau d'entiers correspondant aux allumettes que contiennent chaque étage
            int [][] tab;
            if (NumTas>0) {
                tab = new int[NumTas][NumTas * 2 - 1];
                for (int j = 0; j < NumTas; j++) {
                    for (int i = 1; i <= NumTas * 2 - 1; i++) {
                        if (i <= NumTas + j && i >= NumTas - j) {
                            tab[j][i - 1] = 1;
                        } else {
                            tab[j][i - 1] = 0;
                        }
                    }
                }
            }
            else {
                tab = new int[0][0];
            }
            return tab;
        }

        public static int [][] RetirerAllumettes(Coup k, int [][] t){
            // Cette méthode prend en paramètre un Coup k ainsi qu'un tableau d'entiers t (donnés par le controleur) et génère modifie le tableau t en enlevant un certain nombre d'allumettes sur un certain étage (dépendants du coup donné en paramètre)
            int nbAllumettes = 0;
            int m = k.getNumTas()-1;
            int n = k.getNbAllumettes();
            int [][] p;
            p = new int [1][1];
            p [0][0] = -1; // cette variable nous servira de sortie d'erreur
            if(m>=t.length){ // on vérifie que l'étage dans lequel le joueur souhaite jouer existe dans notre pile
                return p;
            }
            else { // si l'étage existe, on le parcours afin de compter le nombre d'allumettes qu'il possède.
                for(int i=0; i < t[m].length; i++){
                    if(t[m][i]==1){
                        nbAllumettes = nbAllumettes +1;
                    }
                }
            }
            if(n>nbAllumettes && n>=0){ // on vérifie que le nombre d'allumettes que le joueur souhaite retirer est possible (si il ne veut pas retirer plus d'allumettes qu'il y en a de disponible)
                return p;
            }
            else { // si le nombre d'allumettes à retirer est possible, on parcours l'étage et on retire les allumettes une par une, jusqu'à en avoir retiré assez.
                for(int j=0; j < t[m].length && n!=0; j++){
                    if(t[m][j]==1){
                        t[m][j] = 0;
                        n = n-1;
                    }
                }
                return t;
            }

        }

        public static boolean VerifeSiVainqueur(int [][] t){
            // Cette méthode parcours toute notre pile afin de détecter lorsqu'il ne reste plus qu'une seule allumette, afin de terminer la partie.
            int NbrTas = t.length;
            int nbAllumettes = 0;
            for(int i=0; i < NbrTas;i++){
                for(int j=0; j < NbrTas*2-1;j++){
                    if(t[i][j] == 1){
                        nbAllumettes++;
                    }
                }
            }
            if(nbAllumettes == 1){
                return true; // cette valeur sera détectée par le controleur, qui s'occupera de faire afficher les écrans de fin de partie par la suite.
            }
            else{
                return false;
            }
        }
    }
}


