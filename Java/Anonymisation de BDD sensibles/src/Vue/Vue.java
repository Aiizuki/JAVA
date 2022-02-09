package Vue;


import javax.swing.*;
import java.awt.*;

public class Vue {

    public static void main(String[] args)
    {
        JFrame frame = new JFrame("JTable Test");
        JTable table = createTable();
        JButton Pseudo = new JButton("Pseudonymiser");
        JButton Buck = new JButton("Bucketiser");
        JButton Uni = new JButton("Unidimensionnelle");
        JButton Multi = new JButton("Multidimensionnelle");
        JLabel ChooseID = new JLabel("Choisir identifiants");
        JLabel ChooseQID = new JLabel("Choisir quasi identifiants");
        JLabel ChooseData = new JLabel("Choisir données sensibles");
        JLabel BucketSize = new JLabel("Taille du bucket");
        String[] Data = { "Nom", "CP", "Age", "C.E." };
        JComboBox BoxID = new JComboBox(Data);
        JComboBox BoxQID = new JComboBox(Data);
        JComboBox BoxData = new JComboBox(Data);
        JTextField BoxBucketSize = new JTextField();



        frame.setDefaultCloseOperation(WindowConstants.EXIT_ON_CLOSE);
        frame.setLayout(new GridLayout(4,4));
        frame.setSize(400,400);
        frame.setLocationRelativeTo(null);
        frame.getContentPane().add(Pseudo);
        frame.getContentPane().add(Buck);
        frame.getContentPane().add(Uni);
        frame.getContentPane().add(Multi);
        frame.getContentPane().add(ChooseID);
        frame.getContentPane().add(ChooseQID);
        frame.getContentPane().add(ChooseData);
        frame.getContentPane().add(BucketSize);
        frame.getContentPane().add(BoxID);
        frame.getContentPane().add(BoxQID);
        frame.getContentPane().add(BoxData);
        frame.getContentPane().add(BoxBucketSize);
        frame.getContentPane().add(table);
        frame.setVisible(true);
    }

    public static JTable createTable()
    {
        String[] columnNames = {"Nom","CP","Age","C.E."};
        Object[][] data = {{"Sue", "18000", "22", "50"},{"Pat", "69000", "27", "70"}};
        JTable table = new JTable(data, columnNames);
        table.setFillsViewportHeight(true);

        return table;
    }
}
