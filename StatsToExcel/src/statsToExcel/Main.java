package statsToExcel;

public class Main {
    public static void main(String[] args){
    Bdd bdd = new Bdd("root","","RIP");
    Request rqt = new Request(bdd);
    /*String req =*/ rqt.req("Select * from Collaborateurs","first_name");
   // System.out.println(req);
    }
}
