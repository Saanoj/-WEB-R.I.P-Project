package statsToExcel;

import java.util.ArrayList;

public class Main {
    public static void main(String[] args){


        Bdd bdd = new Bdd("root","","RIP");
        Request rqt = new Request(bdd);
        ArrayList req = rqt.req("Select * from users","email");
        System.out.println(req);
    }
}
