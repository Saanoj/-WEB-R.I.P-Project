package statsToExcel;
import java.sql.*;

public class Bdd {


    //  Database credentials
    private String USER;
    private String PASS;
    private String DB_URL;
    private Connection conn = null;

    public Bdd(String user, String pass, String dbName) {
        this.USER = user;
        this.PASS = pass;
        this.DB_URL = "jdbc:mysql://localhost/" + dbName + "?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC";
    }

    public Connection getConn() {
        return conn;
    }

    public void startConnect() {

        try {

            //STEP 3: Open a connection
            System.out.println("Connecting to a selected database...");
            conn = DriverManager.getConnection(DB_URL, USER, PASS);
            System.out.println("Connected database successfully...");

        } catch (SQLException se) {
            //Handle errors for JDBC
            se.printStackTrace();
            System.out.println("Handle errors for JDBC");
        } catch (Exception e) {
            //Handle errors for Class.forName
            e.printStackTrace();
            System.out.println("Handle errors for Class.forName");
        }

    }


    public void stopConnect(Connection conn) {
        //finally block used to close resources
        try {
            if (conn != null)
                conn.close();
        } catch (SQLException se) {
            se.printStackTrace();
        }//end finally try
        System.out.println("Goodbye!");
    }

    /*public void connect2() {


        try{
            //STEP 2: Register JDBC driver
            // Class.forName("com.mysql.jdbc.Driver");

            //STEP 3: Open a connection
            System.out.println("Connecting to a selected database...");
            conn = DriverManager.getConnection(DB_URL, USER, PASS);
            System.out.println("Connected database successfully...");


            Statement stmt = null;
            stmt = conn.createStatement();

            String sql = "SELECT * FROM users";
            ResultSet rs = stmt.executeQuery(sql);

            while(rs.next()){
                //Retrieve by column name
                String email  = rs.getString("email");

                //Display values
                System.out.println("Email: " + email);

            }
            rs.close();

        }catch(SQLException se){
            //Handle errors for JDBC
            se.printStackTrace();
            System.out.println("Handle errors for JDBC");
        }catch(Exception e){
            //Handle errors for Class.forName
            e.printStackTrace();
            System.out.println("Handle errors for Class.forName");
        }finally{
            //finally block used to close resources
            try{
                if(conn!=null)
                    conn.close();
            }catch(SQLException se){
                se.printStackTrace();
            }//end finally try
        }//end try
        System.out.println("Goodbye!");
    }//*/



}


