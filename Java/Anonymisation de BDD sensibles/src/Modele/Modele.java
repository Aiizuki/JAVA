package Modele;
import java.util.Arrays;
import java.util.Comparator;
import java.util.LinkedList;

public class Modele{
    public static class Tableau {
        private String[][] Tableau;
        private String[][] Tableau_Ano;

        public Tableau(String[][] tableau_csv) {
            this.Tableau = tableau_csv;
            this.Tableau_Ano = tableau_csv;
        }

        public String[][] getTableau() {
            //getter qui renvoie le tableau non anonymisé
            return Tableau;
        }

        public String[][] getTableau_Ano() {
            //getter qui renvoie le tableau anonymisé
            return Tableau_Ano;
        }

        private LinkedList<String> GénérerListeID(int total_id) {
            LinkedList<String> Liste_id1 = new LinkedList();
            LinkedList<String> Liste_id2 = new LinkedList();
            String[] Liste_caractère = {"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"};
            int[] Liste_base = {0, 0, 0, 0};
            Liste_id1.add("AAAA");
            String tampon;
            for (int x = 0; x < total_id -1; x++) {
                tampon = "";
                Liste_base[3] = Liste_base[3] + 1;
                for (int y = 3; y > 0; y--) {
                    if (Liste_base[y] == 36) {
                        Liste_base[y] = 0;
                        Liste_base[y - 1] = Liste_base[y - 1] + 1;
                    }
                }
                for (int i : Liste_base) {
                    tampon += Liste_caractère[i];
                }
                Liste_id1.add(tampon);
            }
            for (int w = 0; w < total_id; w++) {
                int e = (int) (Math.random() * (Liste_id1.size()));
                Liste_id2.add(Liste_id1.get(e));
                Liste_id1.remove(e);
            }
            return Liste_id2;
        }

        public String[][] Anonymiser(String[][] tableau, int[] id) {
            //cette méthode prend en entrée un tableau de listes ainsi qu'une liste de int indiquant les colonnes contenants des identifiants
            // et renvoie un nouveau tableau de listes anonymisé.
            LinkedList<String> id_dispo = GénérerListeID(tableau.length * id.length);
            for (int x = 0; x < tableau.length; x++) {
                for (int y = 0; y < tableau[x].length; y++) {
                    for (int z = 0; z < id.length; z++) {
                        if (y == id[z]) {
                            tableau[x][y] = id_dispo.pop();
                        }
                    }
                }
            }
            return tableau;
        }

        public String [][][] Bucketiser(String[][] listeO, int k, int[] Qid, int Dg){
            //cette méthode prend en entrée une liste contenant des QID ainsi que des données sensibles, et renvoit deux tableau : un contenant l'ensemble des
            //QID regroupés dans des groupes et un autre tableau DG regroupant les données sensibles associés à ces mêmes groupes.

            // génération des deux tableaux de sortie, vides.
            String [][] QID = new String[listeO.length][(Qid.length)+1];
            String [][] DG = new String[listeO.length][2];


            //cette partie parcours la liste originelle et pour chaque sous-liste, elle met les Q.ID dans QID et les données sensibles dans DG
            for(int x = 0; x < listeO.length; x++){
                for(int y=0;y<listeO[x].length;y++){
                    for(int z = 0; z<Qid.length; z++){
                        if(y==Qid[z]){
                            QID[x][y] = listeO[x][y];
                            DG[x][0] = listeO[x][Dg];
                        }
                    }
                }
            }

            int n = 0; // cette valeur nous servira d'index au numéro du groupe

            //cette partie parcours notre liste QID et vérifie si, à chaque itération, x est un multiple de k (k étant la quantité de données à stocker dans chaque groupe.)
            // Si c'est le cas, elle vérifie si la liste de base est aussi un multiple de k (pour savoir si on pourra faire des groupes de même taille ou si il y aura un reste)
            for(int x = 0; x < QID.length ; x++){
                if(x%k == 0 && listeO.length%k == 0){
                    // ici, la longueur de listeO est un multiple de k, donc le programme se contente d'incrémenter n de 1 à chaque fois que x est un multiple de k
                    // ( == à chaque fois qu'il y a k éléments dans le groupe numéro n).
                    n = n+1;
                }

                else if(x%k == 0 && listeO.length%k != 0){
                    // ici, la longueur de listeO n'est pas un multiple de k, donc le programme incrémentera n de 1 sauf si le nombre de données non traitées est inférieur à k.
                    // Dans ce cas, le programme n'imcrémente plus n, car sinon on finirait avec un groupe ne respectant pas la k-anonymisation.
                    if(QID.length - x >=k){
                        n = n+1;
                    }
                }

                QID[x][(QID[x].length)-1] = "G".concat(String.valueOf(n));
                DG[x][1] = "G".concat(String.valueOf(n));
            }
            String [][][] resultat = {DG,QID};
            return resultat;
        }

        public void setTableau_Ano(String[][] tableau_Ano) {
            this.Tableau_Ano = tableau_Ano;
        }

        private int taillegroupe(String[][] tableau, int dimension){
            // fonction qui prend en entrée un tableau à deux dimension et un nombre de groupe
            // renvoie le nombre d'indidividus par groupe
            int oui =0;
            int tailletableau = tableau.length;
            boolean divisable = true;
            while(divisable == true){
                if (tailletableau%dimension==0){
                    oui += 1;
                    tailletableau = tailletableau/dimension;
                }
                else {
                    divisable = false;
                    oui = tableau.length/dimension^oui;
                }
            }
            return oui;
        }

        private String flouter(String[] liste){
            // fonction qui prend en entrée un tableau d'entier sous forme de strings
            // renvoie un string sous forme "minimum-maximum" de la liste fournis
            int min = Integer.parseInt(liste[0]);
            int max = Integer.parseInt(liste[0]);
            String a = "";
            for(int x = 0; x< liste.length; x++){
                if(liste[x] == null){
                    ;
                }
                else if(Integer.parseInt(liste[x]) > max){
                    max = Integer.parseInt(liste[x]);
                }
                else if(Integer.parseInt(liste[x]) < min){
                    min = Integer.parseInt(liste[x]);
                }
            }
            if(min == max){
                a += min;
            }
            else{
                a += min+"-"+max;
            }
            return a;
        }

        public String[][] Algo1uni(String[][] letableau, int id, int dimension){
            //fonction qui prend en entrée un tableau et l'indice de la valeur sur laquel apliquer l'algorythme 1 unidimensionel ainsi que le nombre de groupe souhaité
            //renvoie le tableau traité
            String[] laliste = new String[letableau.length]; //creation d'une liste utilisée ligne 176
            String[] cache = new String[taillegroupe(letableau,dimension)+(letableau.length%dimension)]; //creation d'une liste "cache" utilisé ligne 186
            String cache2;//creation d'un string utilisé
            int taillegroupes = taillegroupe(letableau,dimension);
            int lapuissance = 0;
            Arrays.sort(letableau, Comparator.comparing(o -> Integer.parseInt(o[id])));//on applique la fonction de trie avec une fonction comparé personnalisé pour trier le tableau en fonction de l'indice choisi
            for(int x = 0; x < letableau.length; x++) { // on parcour le tableau et on récupère les valeurs de l'indice qui nous intéresse et on les mets dans une liste
                for (int y = 0; y < letableau[x].length; y++) {
                    if (y == id) {
                        laliste[x] = letableau[x][y];
                    }
                }
            }
            for(int x = 0; x< laliste.length; x++){ // on parcour la liste des valeur indentifé par l'indice
                if(x%taillegroupes == 0 && x!= 0){ // si on à parcour l'équivalent de la taille d'un groupe définis par la fonction taillegroupe
                    int marqueur = 0; // on initialise un compteur à 0
                    if(laliste.length-x > taillegroupes) { // si on est pas sur la fin du tableau, et qu'il reste plus de valeurs non parcourus que de valeur en attente de traitement
                        for (int z = x - taillegroupes; z < x; z++) { // on place les valeurs en attente dans le "cache"
                            cache[marqueur] = laliste[z];
                            marqueur += 1;
                        }
                        cache2 = flouter(cache); // on demande à flouter de nous retourner un string de type "minimum-maximum" de la liste "cache"
                        for (int w = x - taillegroupes; w < x; w++) { // on remplace toutes les valeurs du groupe en traitement de la liste par leurs versions flouté
                            laliste[w] = cache2;
                        }
                    }
                    else if(x + taillegroupes == laliste.length ){
                        for (int z = x - taillegroupes; z < x; z++) { // on place les valeurs en attente plus celles restantes dans le "cache"
                            cache[marqueur] = laliste[z];
                            marqueur += 1;
                        }
                        cache2 = flouter(cache); // on demande à flouter de nous retourner un string de type "minimum-maximum" de la liste "cache"
                        for (int w = x - taillegroupes; w < x; w++) { // on remplace toutes les valeurs du groupe en traitement de la liste par leurs versions flouté
                            laliste[w] = cache2;
                        }
                        marqueur = 0;
                        for (int z = x; z < laliste.length; z++) { // on place les valeurs en attente plus celles restantes dans le "cache"
                            cache[marqueur] = laliste[z];
                            marqueur += 1;
                        }
                        cache2 = flouter(cache); // on demande à flouter de nous retourner un string de type "minimum-maximum" de la liste "cache"
                        for (int w = x; w < laliste.length; w++) { // on remplace toutes les valeurs du groupe en traitement de la liste par leurs versions flouté
                            laliste[w] = cache2;
                        }
                    }
                    else { // si on est la fin du tableau, et qu'il reste moins de valeurs non parcourus que de valeur en attente de traitement
                        for (int z = x - taillegroupes; z < laliste.length; z++) { // on place les valeurs en attente plus celles restantes dans le "cache"
                            cache[marqueur] = laliste[z];
                            marqueur += 1;
                        }
                        cache2 = flouter(cache); // on demande à flouter de nous retourner un string de type "minimum-maximum" de la liste "cache"
                        for (int w = x - taillegroupes; w < laliste.length; w++) { // on remplace toutes les valeurs du groupe en traitement de la liste par leurs versions flouté
                            laliste[w] = cache2;
                        }
                    }
                }
            }
            for(int x = 0; x < letableau.length; x++) { // on remplace toutes les valeurs du tableaux par leurs versions traité
                for (int y = 0; y < letableau[x].length; y++) {
                    if (y == id) {
                        letableau[x][y] = laliste[x];
                    }
                }
            }
            return letableau;
        }

        public String[][] Algo1multi(String[][] letableau, int[] id, int dimension){
            //fonction qui prend en entrée un tableau et la liste des indices des valeurs sur laquel apliquer l'algorythme 1 multidimensionel ainsi que le nombre de groupe souhaité
            //renvoie le tableau traité
            String[] laliste = new String[letableau.length];//creation d'une liste utilisée ligne 229
            String[] cache = new String[taillegroupe(letableau,dimension)+(letableau.length%dimension)];//creation d'une liste "cache" utilisé ligne 239
            String cache2;
            int taillegroupes = taillegroupe(letableau,dimension);
            int lapuissance = 0;
            int lead = id[0];
            Arrays.sort(letableau, Comparator.comparing(o -> Integer.parseInt(o[lead])));//on applique la fonction de trie avec une fonction comparé personnalisé pour trier le tableau en fonction du premier indice choisi
            for(int u = 0; u < id.length; u++){ // pour chaque membre de la liste id on applique le code suivant :


                for(int x = 0; x < letableau.length; x++) { // on parcour le tableau et on récupère les valeurs de l'indice qui nous intéresse et on les mets dans une liste
                    for (int y = 0; y < letableau[x].length; y++) {
                        if (y == lead) {
                            laliste[x] = letableau[x][y];
                        }
                    }
                }
                for(int x = 0; x< laliste.length; x++){ // on parcour la liste des valeur indentifé par l'indice
                    if(x%taillegroupes == 0 && x!= 0){ // si on à parcour l'équivalent de la taille d'un groupe définis par la fonction taillegroupe
                        int marqueur = 0; // on initialise un compteur à 0
                        if(laliste.length-x > taillegroupes) { // si on est pas sur la fin du tableau, et qu'il reste plus de valeurs non parcourus que de valeur en attente de traitement
                            for (int z = x - taillegroupes; z < x; z++) { // on place les valeurs en attente dans le "cache"
                                cache[marqueur] = laliste[z];
                                marqueur += 1;
                            }
                            cache2 = flouter(cache); // on demande à flouter de nous retourner un string de type "minimum-maximum" de la liste "cache"
                            for (int w = x - taillegroupes; w < x; w++) { // on remplace toutes les valeurs du groupe en traitement de la liste par leurs versions flouté
                                laliste[w] = cache2;
                            }
                        }
                        else if(x + taillegroupes == laliste.length ){
                            for (int z = x - taillegroupes; z < x; z++) { // on place les valeurs en attente plus celles restantes dans le "cache"
                                cache[marqueur] = laliste[z];
                                marqueur += 1;
                            }
                            cache2 = flouter(cache); // on demande à flouter de nous retourner un string de type "minimum-maximum" de la liste "cache"
                            for (int w = x - taillegroupes; w < x; w++) { // on remplace toutes les valeurs du groupe en traitement de la liste par leurs versions flouté
                                laliste[w] = cache2;
                            }
                            marqueur = 0;
                            for (int z = x; z < laliste.length; z++) { // on place les valeurs en attente plus celles restantes dans le "cache"
                                cache[marqueur] = laliste[z];
                                marqueur += 1;
                            }
                            cache2 = flouter(cache); // on demande à flouter de nous retourner un string de type "minimum-maximum" de la liste "cache"
                            for (int w = x; w < laliste.length; w++) { // on remplace toutes les valeurs du groupe en traitement de la liste par leurs versions flouté
                                laliste[w] = cache2;
                            }
                        }
                        else{ // si on est la fin du tableau, et qu'il reste moins de valeurs non parcourus que de valeur en attente de traitement
                            for (int z = x - taillegroupes; z < laliste.length; z++) { // on place les valeurs en attente plus celles restantes dans le "cache"
                                cache[marqueur] = laliste[z];
                                marqueur += 1;
                            }
                            cache2 = flouter(cache); // on demande à flouter de nous retourner un string de type "minimum-maximum" de la liste "cache"
                            for (int w = x - taillegroupes; w < laliste.length; w++) { // on remplace toutes les valeurs du groupe en traitement de la liste par leurs versions flouté
                                laliste[w] = cache2;
                            }
                        }
                    }
                }
                for(int x = 0; x < letableau.length; x++) { // on remplace toutes les valeurs du tableaux par leurs versions traité
                    for (int y = 0; y < letableau[x].length; y++) {
                        if (y == lead) {
                            letableau[x][y] = laliste[x];
                        }
                    }
                }
            }
            return letableau;
        }
    }
}
