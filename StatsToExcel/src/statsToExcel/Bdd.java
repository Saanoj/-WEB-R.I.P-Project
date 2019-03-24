package statsToExcel;
import java.sql.*;

public class Bdd {
    public Bdd(){

    }
    public void connect() {
        // JDBC driver name and database URL
        final String JDBC_DRIVER = "com.mysql.jdbc.Driver";
        final String DB_URL = "jdbc:mysql://localhost/RIP?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC";

        //  Database credentials
        final String USER = "root";
        final String PASS = "";
        Connection conn = null;

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
    }
}

