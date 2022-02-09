package Appli;
import java.util.Arrays;
import Modele.*;

public class Main {
    public static void main(String[] args)  {
        String[][] tab = {{"jean","26","PD"},{"pierre","25","Pomme"},{"patrick","30","nsm"},{"jean","38","PD"},{"pierre","18","Pomme"},{"patrick","30","nsm"},{"jean","8","PD"},{"pierre","75","Pomme"},{"patrick","46","nsm"},{"pierre","30","Pomme"},{"patrick","5","nsm"},{"pierre","30","Pomme"}};
        Modele.Tableau x = new Modele.Tableau(tab);
        int[] z ={1};
        int u = 2;
        String[][] y = x.Algo1multi(x.getTableau(),z ,4);
        System.out.println(Arrays.toString(y[0]));
        System.out.println(Arrays.toString(y[1]));
        System.out.println(Arrays.toString(y[2]));
        System.out.println(Arrays.toString(y[3]));
        System.out.println(Arrays.toString(y[4]));
        System.out.println(Arrays.toString(y[5]));
        System.out.println(Arrays.toString(y[6]));
        System.out.println(Arrays.toString(y[7]));
        System.out.println(Arrays.toString(y[8]));
        System.out.println(Arrays.toString(y[9]));
        System.out.println(Arrays.toString(y[10]));
        System.out.println(Arrays.toString(y[11]));
    }
}