package modele;
import java.util.Arrays;

public class modele {

    public static class Joueur {
        private int NbWin = 0;

        public int getNbWin() {
            return NbWin;
        }

        public String getNom() {
            return Nom;
        }

        private String Nom;

        public Joueur(String nom) {
            this.Nom = nom;
        }

        public void setNbWin() {
            NbWin = NbWin + 1 ;
        }
    }

    public static class Coup {
        private int NumTas;
        private int NbAllumettes;

        public Coup(int m, int n) {
            this.NumTas = m;
            this.NbAllumettes = n;
        }

        public int getNumTas() {
            return NumTas;
        }

        public int getNbAllumettes() {
            return NbAllumettes;
        }
    }

    public static class Tas implements Cloneable {
        public int[][] Tableau;
        private int NumTas;

        public Tas(int NumTas) {
            this.NumTas = NumTas;
            this.Tableau = TabAllumettes(NumTas);
        }

        public int getNbrTas() {
            return NumTas;
        }

        @Override
         public Tas clone() throws CloneNotSupportedException {
            Tas copie = (Tas) super.clone();
            copie.NumTas = getNbrTas();
            copie.Tableau = new int[NumTas][NumTas*2-1];
            for (int i = 0; i < Tableau.length; i++){
                copie.Tableau[i] = Tableau[i].clone();
            }
            return copie;
        }


        private int [][] TabAllumettes(int NumTas) {
            int [][] tab;
            tab = new int [NumTas][NumTas*2-1];
            for (int j=0;j < NumTas;j++) {
                for (int i=1;i <= NumTas*2-1;i++) {
                    if(i<=NumTas+j && i>=NumTas-j){
                        tab[j][i-1] = 1;
                    }
                    else {tab[j][i-1] = 0;}
                }
            }
            return tab;
        }

        public static int [][] RetirerAllumettes(Coup k, int [][] t){
            int nbAllumettes = 0;
            int m = k.getNumTas()-1;
            int n = k.getNbAllumettes();
            int [][] p;
            p = new int [1][1];
            p [0][0] = 99;
            if(m>=t.length){
                return p;
            }
           else {
                for(int i=0; i < t[m].length; i++){
                    if(t[m][i]==1){
                        nbAllumettes = nbAllumettes+1;
                    }
                }
            }
            if(n>nbAllumettes){
                return p;
            }
            else {
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
                return true;
            }
            else{
                return false;
            }
        }
    }
}


