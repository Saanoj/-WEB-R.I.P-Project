package statsToExcel;

import javax.swing.*;
import java.util.ArrayList;

public class Main {
    public static void main(String[] args){
        JFrame gui = new JFrame("App");
        gui.setContentPane(new App().panelMain);
        gui.get
        gui.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        gui.pack();
        gui.setVisible(true);

        Bdd bdd = new Bdd("root","","RIP");
        Request rqt = new Request(bdd);
        ArrayList req = rqt.req("Select * from users","email");
        System.out.println(req);
    }
}
