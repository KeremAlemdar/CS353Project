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
        final String URL = "jdbc:mysql://localhost:3306/" + dbName;
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
            String sql = "DROP TABLE IF EXISTS tour_activity";
            stmt.executeUpdate(sql);
            System.out.println("tour_activity table is deleted!");

            sql = "DROP TABLE IF EXISTS tour";
            stmt.executeUpdate(sql);
            System.out.println("tour table is deleted!");

            sql = "DROP TABLE IF EXISTS activity";
            stmt.executeUpdate(sql);
            System.out.println("activity table is deleted!");

            //create tables
            sql = "CREATE TABLE activity " +
            "(activity_id INT(12), " +
            " content VARCHAR(255), " +
            " name VARCHAR(255), " +
            " location VARCHAR(255), " +
            " price FLOAT(12,2), " +
            " categories VARCHAR(255), " +
            " PRIMARY KEY ( activity_id ))" +
            " ENGINE=innodb;";
            stmt.executeUpdate(sql);
            System.out.println("activity table created!");

            sql = "CREATE TABLE tour " +
            "(tour_id INT(12), " +
            " start_date DATE, " +
            " end_date DATE, " +
            " tour_information VARCHAR(255), " +
            " PRIMARY KEY ( tour_id ))" +
            " ENGINE=innodb;";
            
            stmt.executeUpdate(sql);
            System.out.println("tour table created!");

            sql = "CREATE TABLE tour_activity " +
            "(activity_id INT(12), " +
            " tour_id INT(12), " +
            " date DATE, " +
            " PRIMARY KEY ( activity_id, tour_id ), " +
            " FOREIGN KEY (activity_id) REFERENCES activity(activity_id), " +
            " FOREIGN KEY (tour_id) REFERENCES tour(tour_id))" +
            " ENGINE=innodb;";
            
            stmt.executeUpdate(sql);
            System.out.println("tour_activity table created!");

            //Tour(tour_id, start_date, end_date, tour_information)
            //Tour_Activity (activity_id, tour_id, date)
            //Activity (activity_id, content, name, location, price, categories)

            //insert tuples to tour
            sql = "INSERT INTO tour " +
            "VALUES ('1', '1997/03/03', '2000/03/03', 'This tour is in besiktas and MUKEMMEL')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO tour " +
            "VALUES ('2', '2001/12/23', '2021/12/20', 'This tour is also MUKEMMEL but in diyarbakir')";
            stmt.executeUpdate(sql);

            //insert tuples to activity
            sql = "INSERT INTO activity " +
            "VALUES ('1', 'Doğa yürüyüşü yapılacak, öğlene doğru mangal yakılıp sucuk kızartılacak.', 'Doğa Yürüyüşü', 'Ankara Dağı', 100, 'Doğa, Yürüyüş, Sucuk, Dağ, Ankara')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO activity " +
            "VALUES ('2', 'Teleferik ile dağa çıkılıp 30 dakika etraf gezilecek. Kafeler ve yemek yerleri gösterilecek. Sonrasında dağdan aşağıya eğitimli kayak dersimiz olacak.', 'Kayak Turu', 'Erciyes Dağı', 150, 'Kar, Kayak, Dağ, Erciyes')";
            stmt.executeUpdate(sql);

            //insert tuples to tour_activity
            sql = "INSERT INTO tour_activity " +
            "VALUES ('1', '1', '1998/11/20')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO tour_activity " +
            "VALUES ('1', '2', '1999/01/20')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO tour_activity " +
            "VALUES ('2', '1', '2020/08/13')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO tour_activity " +
            "VALUES ('2', '2', '2021/11/20')";
            stmt.executeUpdate(sql);



            // System.out.println("------------------1----------------");
            // sql = "SELECT bdate,address,city " +
            // "FROM customer," +
            // "(SELECT MIN(wallet) as minwallet " +
            // "FROM customer) A " + 
            // "WHERE customer.wallet=A.minwallet";
            // printSql(sql,stmt);
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
