package statsToExcel;

import javax.swing.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class App {
    public JPanel panelMain;
    private JButton Hello_button;
    private JFormattedTextField sql;
    private JFormattedTextField column;

    public App() {
        Hello_button.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                System.out.println("hey");
            }
        });
    }
}
