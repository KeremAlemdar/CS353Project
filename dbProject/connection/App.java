import java.sql.*;
public class App {
    public static void main(String[] args) throws Exception {
        try
        {
            Class.forName("com.mysql.cj.jdbc.Driver");
        }
        catch(ClassNotFoundException e)
        {
            System.out.println("JDBC Driver NOT FOUND!");
        }


        final String dbName = "dbproject";
        final String URL = "jdbc:mysql://localhost:33076" + dbName;
        final String user = "root";
        final String pass = "";        

        Connection con = null;
        Statement stmt = null;

        try
        {
            con = DriverManager.getConnection(URL, user, pass);
            if(con != null)
            {
                System.out.println("SUCCESFUL CONNECTION");
            }
            else
            {
                System.out.println("CANNOT CONNECT");
            }
        }
        catch(SQLException e)
        {
            System.out.println("CANNOT CONNECT2");
            //e.printStackTrace();
        }

        //SQL Part
        try
        {
            stmt = con.createStatement();

            //drop tables
            String sql = "DROP TABLE IF EXISTS buy";
            stmt.executeUpdate(sql);
            System.out.println("buy table is deleted!");
            sql = "DROP TABLE IF EXISTS customer";
            stmt.executeUpdate(sql);
            System.out.println("customer table is deleted!");
            sql = "DROP TABLE IF EXISTS product";
            stmt.executeUpdate(sql);
            System.out.println("product table is deleted!");

            //create tables
            sql = "CREATE TABLE customer " +
            "(cid CHAR(12), " +
            " cname VARCHAR(50), " +
            " bdate DATE, " +
            " address VARCHAR(50), " +
            " city VARCHAR(20), " +
            " wallet FLOAT, " +
            " PRIMARY KEY ( cid ))" +
            " ENGINE=innodb;";
            
            stmt.executeUpdate(sql);
            System.out.println("buy table created!");

            //insert tuples to customer
            sql = "INSERT INTO customer " +
            "VALUES ('C101', 'Ali', '1997/03/03', 'Besiktas', 'Istanbul', 114.50)";
            stmt.executeUpdate(sql);

            System.out.println("------------------1----------------");
            sql = "SELECT bdate,address,city " +
            "FROM customer," +
            "(SELECT MIN(wallet) as minwallet " +
            "FROM customer) A " + 
            "WHERE customer.wallet=A.minwallet";
            printSql(sql,stmt);
        }
        catch(SQLException e)
        {
            System.out.println("SQL Exception Happened:" + e.getMessage());
            //e.printStackTrace();
        }
    }
    public static void printSql(String sql, Statement stmt) throws SQLException {
        ResultSet rs = stmt.executeQuery(sql);
        ResultSetMetaData rsmd = rs.getMetaData();
        int columnsNumber = rsmd.getColumnCount();
        for(int i = 1; i <=columnsNumber; i++) {
            if(i == 1) {
                System.out.print(rsmd.getColumnName(i));
            }
            else {
                System.out.print(" | " + rsmd.getColumnName(i));
            }
        }
        while(rs.next()){
            System.out.println();
            for(int i = 1; i <=columnsNumber; i++) {
                if(i == 1) {
                    System.out.print(rs.getString(i));
                }
                else {
                    System.out.print(", " + rs.getString(i));
                }
            }
        }
        System.out.println();
        rs.close();
    }
}
