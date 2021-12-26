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


            
            // //drop tables
            String sql = "DROP TABLE IF EXISTS account";       
            stmt.executeUpdate(sql);
            System.out.println("tour table is deleted!");  

            sql = "DROP TABLE IF EXISTS Employee";       
            stmt.executeUpdate(sql);
            System.out.println("Employee table is deleted!"); 

            sql = "DROP TABLE IF EXISTS tour_activity";
            stmt.executeUpdate(sql);
            System.out.println("tour_activity table is deleted!");

            sql = "DROP TABLE IF EXISTS bucket";
            stmt.executeUpdate(sql);
            System.out.println("bucket table is deleted!");

            sql = "DROP TABLE IF EXISTS evaluate_tour";
            stmt.executeUpdate(sql);
            System.out.println("evaluate_tour table is deleted!");

            stmt.executeUpdate(sql);
            System.out.println("account table is deleted!");

            sql = "DROP TABLE IF EXISTS customer";
            stmt.executeUpdate(sql);
            System.out.println("customer table is deleted!");

            sql = "DROP TABLE IF EXISTS tour";
            stmt.executeUpdate(sql);
            System.out.println("tour table is deleted!");

            sql = "DROP TABLE IF EXISTS activity";
            stmt.executeUpdate(sql);
            System.out.println("activity table is deleted!");

            sql = "DROP TABLE IF EXISTS Flight";
            stmt.executeUpdate(sql);
            System.out.println("Flight table is deleted!");

            sql = "DROP TABLE IF EXISTS Airport";
            stmt.executeUpdate(sql);
            System.out.println("Airport table is deleted!");

            sql = "DROP TABLE IF EXISTS Hotel";
            stmt.executeUpdate(sql);
            System.out.println("Hotel table is deleted!");

            sql = "DROP TABLE IF EXISTS Reservation";
            stmt.executeUpdate(sql);
            System.out.println("Reservation table is deleted!");

            sql = "DROP TABLE IF EXISTS reserve";
            stmt.executeUpdate(sql);
            System.out.println("reserve table is deleted!");

            // create tables

            //Missing Foreign Key, will be added
            sql = "CREATE TABLE account " +
            "(user_id INT(12), " +
            " username VARCHAR(50), " +
            " password VARCHAR(50), " +
            " email VARCHAR(50), " +
            " phone_num VARCHAR(50), " +
            " name VARCHAR(50), " +
            " surname VARCHAR(50), " +
            " PRIMARY KEY ( user_id ))" +
            " ENGINE=innodb;";
            
            stmt.executeUpdate(sql);
            System.out.println("account table created!");

            sql = "CREATE TABLE customer " +
            "(customer_id INT(12), " +
            " PRIMARY KEY ( customer_id )) " +
            " ENGINE=innodb;";
            
            stmt.executeUpdate(sql);
            System.out.println("customer table created!");

            sql = "CREATE TABLE Employee " +
            "(employee_id INT(12), " +
            " PRIMARY KEY ( employee_id )) " +
            " ENGINE=innodb;";
            
            stmt.executeUpdate(sql);
            System.out.println("Employee table created!");

            sql = "CREATE TABLE activity " +
            "(activity_id INT(12), " +
            " content VARCHAR(255), " +
            " name VARCHAR(255), " +
            " location VARCHAR(255), " +
            " price FLOAT(12,2), " +
            " categories VARCHAR(255), " +
            " image VARCHAR(255), " +
            " PRIMARY KEY ( activity_id ))" +
            " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("activity table created!");

            sql = "CREATE TABLE tour " +
            "(tour_id INT(12), " +
            " start_date DATE, " +
            " end_date DATE, " +
            " tour_information VARCHAR(255), " +
            " image VARCHAR(255), " +
            " tour_name VARCHAR(255), " +
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

            sql = "CREATE TABLE bucket " +
            "(user_id INT(12), " +
            " activity_id INT(12), " +
            " tour_id INT(12), " +
            " date DATE, " +
            " PRIMARY KEY ( user_id, tour_id ), " +
            " FOREIGN KEY (activity_id) REFERENCES activity(activity_id), " +
            " FOREIGN KEY (tour_id) REFERENCES tour(tour_id))" +
            " ENGINE=innodb;";
            
            stmt.executeUpdate(sql);
            System.out.println("bucket table created!");

            sql = "CREATE TABLE evaluate_tour " +
            "(tour_id INT(12), " +
            " customer_id INT(12), " +
            " rate INT(12), " +
            " PRIMARY KEY ( tour_id, customer_id ), " +
            " FOREIGN KEY (tour_id) REFERENCES tour(tour_id), " +
            " FOREIGN KEY (customer_id) REFERENCES customer(customer_id))" +
            " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("evaluate_tour table created!");

            sql = "CREATE TABLE Airport " +
            "(airport_id INT(12) AUTO_INCREMENT, " +
            " city varchar(255), " +
            " PRIMARY KEY ( airport_id ))" +
            " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("Airport table created!");

            sql = "CREATE TABLE Flight " +
            "(flight_id INT(12) AUTO_INCREMENT, " +
            " departure_time DATETIME, " +
            " arrival_time DATETIME, " +
            " departure_airport INT(12), " +
            " arrival_airport INT(12), " +
            " PRIMARY KEY ( flight_id ), " +
            " FOREIGN KEY (departure_airport) REFERENCES Airport(airport_id), " +
            " FOREIGN KEY (arrival_airport) REFERENCES Airport(airport_id))" +
            " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("Flight table created!");

            sql = "CREATE TABLE Hotel " +
            "(hotel_id INT(12) AUTO_INCREMENT, " +
            " name varchar(50), " +
            " city varchar(50), " +
            " star INT(12), " +
            " PRIMARY KEY ( hotel_id )) " +
            " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("Hotel table created!");

            sql = "CREATE TABLE Reservation " +
            "(reservation_id INT(12) AUTO_INCREMENT, " +
            " reservation_type varchar(50), " +
            " amount_of_people INT(12), " +
            " start_date DATE, " +
            " end_date DATE, " +
            " PRIMARY KEY ( reservation_id )) " +
            " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("Reservation table created!");

            sql = "CREATE TABLE reserve " +
            "(reservation_id INT(12), " +
            " employee_id INT(12), " +
            " customer_id INT(12), " +
            " PRIMARY KEY ( reservation_id, employee_id, customer_id ), " +
            " FOREIGN KEY (reservation_id) REFERENCES Reservation(reservation_id), " +
            " FOREIGN KEY (employee_id) REFERENCES Employee(employee_id)," +
            " FOREIGN KEY (customer_id) REFERENCES customer(customer_id))" +
            " ENGINE=innodb;";

            stmt.executeUpdate(sql);
            System.out.println("reserve table created!");

            //Tour(tour_id, start_date, end_date, tour_information)
            //Tour_Activity (activity_id, tour_id, date)
            //Activity (activity_id, content, name, location, price, categories)

            //insert tuples to tour
            sql = "INSERT INTO tour " +
            "VALUES ('1', '1997/03/03', '2000/03/03', 'This tour is in besiktas and MUKEMMEL', 'tour1.jpg', 'France Tour')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO tour " +
            "VALUES ('2', '2001/12/23', '2021/12/20', 'This tour is also MUKEMMEL but in diyarbakir', 'tour2.jpg', 'Loire Valley Tour')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO tour " +
            "VALUES ('3', '1997/03/03', '2000/03/03', 'This tour is in besiktas and MUKEMMEL', 'tour1.jpg', 'France Tour')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO tour " +
            "VALUES ('4', '2001/12/23', '2021/12/20', 'This tour is also MUKEMMEL but in diyarbakir', 'tour2.jpg', 'Loire Valley Tour')";
            stmt.executeUpdate(sql);

            //insert tuples to activity
            sql = "INSERT INTO activity " +
            "VALUES ('1', 'Doğa yürüyüşü yapılacak, öğlene doğru mangal yakılıp sucuk kızartılacak.', 'Doğa Yürüyüşü', 'Ankara Dağı', 100, 'Doğa, Yürüyüş, Sucuk, Dağ, Ankara', 'activity1.jpg')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO activity " +
            "VALUES ('2', 'Teleferik ile dağa çıkılıp 30 dakika etraf gezilecek. Kafeler ve yemek yerleri gösterilecek. Sonrasında dağdan aşağıya eğitimli kayak dersimiz olacak.', 'Kayak Turu', 'Erciyes Dağı', 150, 'Kar, Kayak, Dağ, Erciyes', 'activity2.jpg')";
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

            //insert tuples to bucket
            sql = "INSERT INTO bucket " +
            "VALUES ('1', null, '1', null)";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO bucket " +
            "VALUES ('1', null, '2', null)";
            stmt.executeUpdate(sql);

            //insert tuples to bucket
            sql = "INSERT INTO Airport (city) " +
            "VALUES ( 'Ankara' )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO Airport (city)" +
            "VALUES ( 'Istanbul' )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO Airport (city)" +
            "VALUES ( 'Bolu' )";
            stmt.executeUpdate(sql);

            //insert tuples to bucket
            sql = "INSERT INTO Hotel (name, city ,star) " +
            "VALUES ( 'Bilkent Hotel', 'Ankara', '400' )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO Hotel (name, city ,star) " +
            "VALUES ( 'Kerem Hotel', 'Ankara', '31' )";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO Hotel (name, city ,star) " +
            "VALUES ( 'Ismet Hotel', 'Ankara', '100' )";
            stmt.executeUpdate(sql);

            //insert tuples to bucket
            sql = "INSERT INTO Flight (departure_time, arrival_time, departure_airport, arrival_airport) " +
            "VALUES ( '2021/12/25 13:30:00', '2021/12/25 15:30:00', '1', '2')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO Flight (departure_time, arrival_time, departure_airport, arrival_airport) " +
            "VALUES ( '2021/12/25 16:30:00', '2021/12/25 17:30:00', '1', '2')";
            stmt.executeUpdate(sql);
            sql = "INSERT INTO Flight (departure_time, arrival_time, departure_airport, arrival_airport) " +
            "VALUES ( '2021/12/25 13:30:00', '2021/12/25 15:30:00', '2', '1')";
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
